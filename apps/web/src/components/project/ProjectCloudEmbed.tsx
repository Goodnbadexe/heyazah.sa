'use client';

import { useState } from 'react';
import { projectHeroImage, type Project } from '@/lib/data/projects';
import type { Locale } from '@/lib/i18n/locales';

export function ProjectCloudEmbed({ project, locale }: { project: Project; locale: Locale }) {
  const [isActive, setIsActive] = useState(false);

  // Determine the primary embed source based on hierarchy in IMMERSIVE_3D_360_PLAN
  const cloudEmbedUrl = project.cloud_embed?.embed_url;
  const modelUrl = project.project_experience?.model?.glb_url || project.project_model_url;
  const tourUrl = project.project_experience?.tours?.[0]?.url || project.project_360_tours?.[0]?.url || project.media?.virtual_tour_url;
  
  if (!cloudEmbedUrl && !modelUrl && !tourUrl) return null;

  const posterUrl = project.cloud_embed?.poster_url || project.project_experience?.model?.poster_url || projectHeroImage(project);

  return (
    <section className="bg-heyazah-fog py-20">
      <div className="container">
        <div className="mb-10 text-center">
          <p className="text-sm uppercase tracking-[0.3em] text-heyazah-accent">
            {locale === 'ar' ? 'نموذج ثلاثي الأبعاد' : '3D Immersive'}
          </p>
          <h2 className="mt-2 text-3xl font-medium md:text-5xl text-heyazah-primary">
            {locale === 'ar' ? 'استكشف المشروع' : 'Explore the Project'}
          </h2>
        </div>

        <div className="relative mx-auto aspect-[4/3] md:aspect-[16/9] w-full max-w-6xl overflow-hidden rounded-3xl bg-heyazah-ink shadow-2xl">
          {!isActive && (
            <div className="absolute inset-0 z-10 flex flex-col items-center justify-center bg-black/40">
              {posterUrl && (
                // eslint-disable-next-line @next/next/no-img-element
                <img
                  src={posterUrl}
                  alt="Project Preview"
                  className="absolute inset-0 -z-10 h-full w-full object-cover opacity-80"
                />
              )}
              <button
                onClick={() => setIsActive(true)}
                className="group flex flex-col items-center gap-4 transition-transform duration-500 ease-dramatic hover:scale-110 focus:outline-none"
              >
                <div className="flex h-20 w-20 items-center justify-center rounded-full bg-heyazah-paper/20 pl-1 text-white shadow-lg backdrop-blur-md border border-white/30 transition-all duration-500 group-hover:bg-heyazah-accent/90 group-hover:border-transparent">
                  <svg className="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z" />
                  </svg>
                </div>
                <span className="text-lg font-semibold tracking-wide text-white drop-shadow-md">
                  {locale === 'ar' ? 'بدء التجربة التفاعلية' : 'Start Interactive Experience'}
                </span>
              </button>
            </div>
          )}

          {isActive && cloudEmbedUrl && (
            <iframe
              src={cloudEmbedUrl}
              className="h-full w-full border-none"
              allow="fullscreen; xr-spatial-tracking; gyroscope; accelerometer"
            />
          )}

          {/* Fallback to model-viewer */}
          {isActive && !cloudEmbedUrl && modelUrl && (
            <div className="flex h-full w-full items-center justify-center bg-heyazah-fog">
              {/* @ts-expect-error custom element */}
              <model-viewer
                src={modelUrl}
                camera-controls
                auto-rotate
                ar
                shadow-intensity="0.8"
                style={{ width: '100%', height: '100%' }}
              />
            </div>
          )}

          {/* Fallback to virtual tour framing */}
          {isActive && !cloudEmbedUrl && !modelUrl && tourUrl && (
            <iframe
              src={tourUrl}
              className="h-full w-full border-none"
              allow="fullscreen; xr-spatial-tracking; gyroscope; accelerometer"
            />
          )}
        </div>
      </div>
    </section>
  );
}
