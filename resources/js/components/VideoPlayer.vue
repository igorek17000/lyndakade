<template>
  <video
    id="video"
    class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9 w-100"
    preload="auto"
    controls
    :poster="thumbnailUrl"
    data-setup="{ 'fluid' : true , 'preload' : 'auto'}"
  >
    <source type="video/mp4" :src="videoUrl" />
  </video>
</template>
<script>
import videojs from "video.js";

export default {
  data() {
    return {
      player: null,
      duration: null,
    };
  },
  props: {
    videoUrl: null,
    thumbnailUrl: null,
    videoUid: null,
  },
  methods: {},
  mounted() {
    this.player = videojs("video");
    this.player.on("loadedmetadata", () => {
      this.duration = Math.round(this.player.duration());
    });
  },
};
</script>
