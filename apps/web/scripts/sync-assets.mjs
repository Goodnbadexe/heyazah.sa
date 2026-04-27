#!/usr/bin/env node
/**
 * Mirrors migration/assets/ into apps/web/public/assets/
 * so Next.js can serve logos, icons, fonts, and brand guidelines.
 *
 * Safe to run repeatedly; it uses hard copies so dev + build work on any OS.
 */
import { cp, mkdir } from 'node:fs/promises';
import { existsSync } from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const src = path.resolve(__dirname, '..', '..', '..', 'migration', 'assets');
const dst = path.resolve(__dirname, '..', 'public', 'assets');

if (!existsSync(src)) {
  console.error(`[sync-assets] missing source: ${src}`);
  process.exit(1);
}
await mkdir(dst, { recursive: true });

await cp(src, dst, { recursive: true, force: true });
console.log(`[sync-assets] copied ${src} -> ${dst}`);
