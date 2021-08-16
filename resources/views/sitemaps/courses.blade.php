<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($items as $item)
    <url>
      <loc>{{ route($route_name, $item->slug_linkedin) }}</loc>
      <lastmod>{{ $today_date }}</lastmod>
      <changefreq>daily</changefreq>
      <priority>{{ $priority }}</priority>
      <video:video>
        <video:thumbnail_loc>
          {{ fromDLHost($item->img) }}
        </video:thumbnail_loc>
        <video:title>
        @php
            echo "<![CDATA[". $item->title . " }} ]]>";
        @endphp
        </video:title>
        <video:description>
        @php
            echo "<![CDATA[". $item->description . " }} ]]>";
        @endphp
        </video:description>
        <video:publication_date>{{ $item->releaseDate }}</video:publication_date>
      </video:video>
    </url>
  @endforeach
</urlset>
