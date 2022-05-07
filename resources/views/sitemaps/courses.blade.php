@php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($items as $item)
    <url>
      <loc>{{ route($route_name, $item->slug_linkedin) }}</loc>
      @php
        echo "<video:video>
            <video:thumbnail_loc>" .
            fromDLHost($item->img) .
            "</video:thumbnail_loc>
            <video:title>$item->title</video:title>
            <video:description>$item->description</video:description>
            <video:publication_date>" .
            \Carbon\Carbon::parse($item->releaseDate) .
            "</video:publication_date>
            <video:content_loc>" .
            fromDLHost($item->previewFile) .
            "</video:content_loc>
            <video:duration>" .
            ($item->durationHours * 60 + $item->durationMinutes) * 60 .
            "</video:duration>
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
