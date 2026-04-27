import { NextResponse, type NextRequest } from 'next/server';
import { defaultLocale, locales } from '@/lib/i18n/locales';

const PUBLIC_FILE = /\.(?:svg|png|jpg|jpeg|gif|ico|webp|avif|mp4|webm|woff2?|ttf|otf|json|xml|txt)$/i;

export function middleware(request: NextRequest) {
  const { pathname } = request.nextUrl;

  if (
    pathname.startsWith('/_next') ||
    pathname.startsWith('/api') ||
    pathname.startsWith('/assets') ||
    PUBLIC_FILE.test(pathname)
  ) {
    return NextResponse.next();
  }

  const hasLocale = locales.some(
    (l) => pathname === `/${l}` || pathname.startsWith(`/${l}/`),
  );
  if (hasLocale) return NextResponse.next();

  // Prefer browser Accept-Language if it starts with ar or en; otherwise default.
  const accept = request.headers.get('accept-language') ?? '';
  const preferred = accept.toLowerCase().startsWith('en') ? 'en' : defaultLocale;

  const url = request.nextUrl.clone();
  url.pathname = `/${preferred}${pathname === '/' ? '' : pathname}`;
  return NextResponse.redirect(url);
}

export const config = {
  matcher: ['/((?!_next|api|assets|favicon.ico).*)'],
};
