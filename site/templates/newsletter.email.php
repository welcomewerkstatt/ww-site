<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page->title() ?></title>
<style>
    body {
      font-family: system-ui, sans-serif;
      font-weight: normal;
      font-size: 16px;
      line-height: 1.5;
    }

    p {
      margin-top: 0;
    }
    
    main {
      max-width: 800px;
      margin: 0 auto;
      padding: 16px;
      background: white;
      display: flex;
      flex-direction: column;
    }

    .block {
      padding: 8px;

      .block-content {
        display: flex;
        flex-direction: column;
        gap: 16px;
      }

      .block-text {
        display: flex;
        flex-direction: column;
      }

      .block-item {
        display: flex;
        flex-direction: column;
      }

      .divider {
        border-bottom: 1px solid #ccc;
        padding-bottom: 4px;
        margin-bottom: 8px;
      }

      .block-image {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;

        img {
          max-width: 400px;
          width: 100%;
          height: auto;
        }
      }
    }
  </style>
</head>

<body>
  <main>
    <?php snippet('newsletter-blocks') ?>
  </main>
</body>

</html>