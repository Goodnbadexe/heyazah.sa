import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));

/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: true,
  outputFileTracingRoot: path.join(__dirname, '../../'),
  experimental: {
    // Allow importing the shared migration JSON from outside src/.
    externalDir: true,
  },
  images: {
    remotePatterns: [
      { protocol: 'https', hostname: 'heyazah.sa' },
      { protocol: 'https', hostname: 'heyazah.com' },
      { protocol: 'https', hostname: 'heyazah.cloud' },
    ],
  },
  i18n: undefined, // App Router handles i18n via [locale] segment + middleware
};

export default nextConfig;
