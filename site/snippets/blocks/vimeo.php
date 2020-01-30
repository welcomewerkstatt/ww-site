<h4><?= $data->headline()->html() ?></h4>
<div style="padding:56.25% 0 0 0;position:relative;">
  <iframe src="<?= $data->url() ?>" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
</div>
<script defer src="https://player.vimeo.com/api/player.js"></script>