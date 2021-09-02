<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <sitemap>
    <loc>https://lyndakade.ir/sitemap-authors.xml</loc>
    <lastmod>{{ $today_date }}</lastmod>
  </sitemap>
  <sitemap>
    <loc>https://lyndakade.ir/sitemap-partials.xml</loc>
    <lastmod>{{ $today_date }}</lastmod>
  </sitemap>
  <sitemap>
    <loc>https://lyndakade.ir/sitemap-subjects.xml</loc>
    <lastmod>{{ $today_date }}</lastmod>
  </sitemap>
  <sitemap>
    <loc>https://lyndakade.ir/sitemap-learn-paths.xml</loc>
    <lastmod>{{ $today_date }}</lastmod>
  </sitemap>
  @foreach ($courses_dates as $c_d)
    <sitemap>
      <loc>https://lyndakade.ir/{{ 'sitemap-courses-' . $c_d . '.xml' }}</loc>
      <lastmod>{{ $today_date }}</lastmod>
    </sitemap>
  @endforeach
</sitemapindex>
