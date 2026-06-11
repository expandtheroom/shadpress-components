#!/usr/bin/env node
/**
 * Downloads Lucide SVG icons and generates PHP + JSON data files.
 * Run: make generate-icons
 * Or directly: node themes/shadpress-starter/components/lucide-icons/icon-setup.js
 */

import { execSync } from 'node:child_process'
import {
  existsSync,
  rmSync,
  mkdirSync,
  readdirSync,
  readFileSync,
  writeFileSync,
} from 'node:fs'
import { join, dirname } from 'node:path'
import { fileURLToPath } from 'node:url'

const COMPONENT_DIR = dirname(fileURLToPath(import.meta.url))
const ICONS_DIR = join(COMPONENT_DIR, 'icons')
const TMP_DIR = join(COMPONENT_DIR, '.tmp-lucide')

// 1. Clean temp dir and download lucide-static via npm pack
console.log('Downloading lucide-static...')
if (existsSync(TMP_DIR)) rmSync(TMP_DIR, { recursive: true })
mkdirSync(TMP_DIR)
execSync(`npm pack lucide-static --pack-destination "${TMP_DIR}"`, {
  stdio: 'pipe',
})
execSync(`tar -xzf "${TMP_DIR}"/*.tgz -C "${TMP_DIR}"`)

// 2. Copy SVG files to icons/
console.log('Copying SVG files...')
if (existsSync(ICONS_DIR)) rmSync(ICONS_DIR, { recursive: true })
mkdirSync(ICONS_DIR)
execSync(`cp "${TMP_DIR}/package/icons/"*.svg "${ICONS_DIR}/"`)

// 3. Read tags from the downloaded package (no extra network fetch needed)
console.log('Reading icon metadata...')
const tagsPath = join(TMP_DIR, 'package', 'tags.json')
const tagsByIcon = existsSync(tagsPath)
  ? JSON.parse(readFileSync(tagsPath, 'utf8'))
  : {}

// 4. Read all downloaded SVG files
const svgFiles = readdirSync(ICONS_DIR)
  .filter((f) => f.endsWith('.svg'))
  .sort()

// 5. Generate lucide-icons-data.php
console.log('Generating lucide-icons-data.php...')
const phpLines = svgFiles.map((file) => {
  const name = file.replace('.svg', '')
  const raw = readFileSync(join(ICONS_DIR, file), 'utf8').trim()
  const minified = raw.replace(/\s+/g, ' ').replace(/> </g, '><')
  const escaped = minified.replace(/\\/g, '\\\\').replace(/'/g, "\\'")
  return `    '${name}' => '${escaped}',`
})
writeFileSync(
  join(COMPONENT_DIR, 'lucide-icons-data.php'),
  `<?php\n\nreturn [\n${phpLines.join('\n')}\n];\n`
)

// 6. Generate icon-manifest.json
console.log('Generating icon-manifest.json...')
const manifest = svgFiles.map((file) => {
  const name = file.replace('.svg', '')
  return { name, categories: tagsByIcon[name] ?? [] }
})
writeFileSync(
  join(COMPONENT_DIR, 'icon-manifest.json'),
  JSON.stringify(manifest, null, 2) + '\n'
)

// 7. Cleanup
rmSync(TMP_DIR, { recursive: true })
console.log(`Done — ${svgFiles.length} icons processed.`)
