<style>
  div#online {
    position: relative;
    margin-top: 8px;
    float: right;
    margin-right: 16px;
    margin-left: -10px;
  }

  .dot:before {
    content: ' ';
    position: absolute;
    z-index: 2;
    left: 10px;
    top: 10px;
    width: 10px;
    height: 10px;
    background-color: #4CAF4F;
    border-radius: 50%;
  }
</style>
<div id="online">
  <div class="dot">
    <div class="spinner-grow text-success" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
</div>
