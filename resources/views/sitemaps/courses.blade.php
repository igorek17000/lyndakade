<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($items as $item)
    <url>
      <loc>{{ route($route_name, $item->slug_linkedin) }}</loc>
      <lastmod>{{ $today_date }}</lastmod>
      <changefreq>daily</changefreq>
      <priority>{{ $priority }}</priority>
        {{-- @php
            echo "<video:video>
            <video:thumbnail_loc>
            " . fromDLHost($item->img) . "
            </video:thumbnail_loc>
            <video:title>
            " . $item->title . "
            </video:title>
            <video:description>
            " . $item->description . "
            </video:description>
            <video:publication_date>
            " . $item->releaseDate . "
            </video:publication_date>
            </video:video>";
        @endphp --}}
    </url>
  @endforeach
</urlset>
