"use client";

import { useState } from "react";
import Link from "next/link";
import { motion } from "framer-motion";
import { featured, displayName } from "@/lib/data/projects";
import { t } from "@/lib/i18n/dictionary";
import type { Locale } from "@/lib/i18n/locales";

export function PortfolioList({ locale }: { locale: Locale }) {
  const [hoveredIndex, setHoveredIndex] = useState<number | null>(null);

  return (
    <section className="container py-24 bg-heyazah-primary text-heyazah-paper">
      <div className="mb-16">
        <p className="text-sm uppercase tracking-[0.3em] text-heyazah-accent mb-4">
          {locale === "ar" ? "أبرز المشاريع" : "Selected work"}
        </p>
      </div>

      <ul
        className="flex flex-col gap-6 w-full max-w-5xl mx-auto"
        onMouseLeave={() => setHoveredIndex(null)}
      >
        {featured.map((p, i) => {
          const isHovered = hoveredIndex === i;
          const isOtherHovered = hoveredIndex !== null && hoveredIndex !== i;

          return (
            <li
              key={p.id}
              className="relative"
              onMouseEnter={() => setHoveredIndex(i)}
            >
              <Link
                href={`/${locale}/portfolio/${p.slug}`}
                className="block relative w-full"
              >
                <motion.div
                  className="flex items-center"
                  initial={false}
                  animate={{
                    opacity: isOtherHovered ? 0.3 : 1,
                    filter: isOtherHovered ? "blur(4px)" : "blur(0px)",
                    x: isHovered ? (locale === "ar" ? -30 : 30) : 0,
                  }}
                  transition={{ duration: 0.4, ease: [0.16, 1, 0.3, 1] }}
                >
                  <motion.span
                    className="absolute font-bold text-heyazah-accent text-4xl md:text-6xl"
                    initial={false}
                    animate={{
                      opacity: isHovered ? 1 : 0,
                      x: isHovered
                        ? locale === "ar"
                          ? 30
                          : -30
                        : locale === "ar"
                          ? 60
                          : -60,
                    }}
                    transition={{ duration: 0.4, ease: [0.16, 1, 0.3, 1] }}
                  >
                    {locale === "ar" ? "←" : "→"}
                  </motion.span>
                  <h3 className="text-5xl md:text-7xl font-bold tracking-tight">
                    {displayName(p, locale)}
                  </h3>
                </motion.div>
              </Link>
            </li>
          );
        })}
      </ul>
    </section>
  );
}
