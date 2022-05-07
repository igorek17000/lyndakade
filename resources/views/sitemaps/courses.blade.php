<?php echo '<?xml version="1.0" encoding="UTF-8">'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">
  @foreach ($items as $item)
    <url>
      <loc>{{ route($route_name, $item->slug_linkedin) }}</loc>
      @php
        echo "<video:video>
            <video:thumbnail_loc>$item->img</video:thumbnail_loc>
            <video:title>$item->title</video:title>
            <video:description>$item->description</video:description>
            <video:publication_date>$item->releaseDate</video:publication_date>
            <video:content_loc>$item->previewFile</video:content_loc>
            <video:duration>$item->duration</video:duration>
            <video:tag>دانلود دوره آموزشی از لینکدین رایگان</video:tag>
            <video:tag>دانلود دوره آموزشی از لیندا رایگان</video:tag>
            <video:tag>دانلود دوره آموزشی رایگان</video:tag>
            <video:tag>لینداکده</video:tag>
            </video:video>
            ";
      @endphp
      <lastmod>{{ $today_date }}</lastmod>
      <changefreq>daily</changefreq>
      <priority>{{ $priority }}</priority>
    </url>
  @endforeach
</urlset>
