import type { Metadata } from 'next';
import '@/styles/globals.css';

export const metadata: Metadata = {
  title: 'Heyazah — حيازة',
  description: 'Heyazah develops landmark destinations across Riyadh. منذ 2005 نطوّر وجهات حضرية وسكنية.',
  metadataBase: new URL('https://heyazah.sa'),
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  // The actual <html dir> is set by the [locale] layout based on the URL segment.
  return children;
}
