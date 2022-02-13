# Welcome Werkstatt Website

This is the main repository for the website of Welcome Werkstatt e. V. This repo is based on the Kirby Starterkit.

## Structure
This repository makes use of [Git submodules](https://git-scm.com/book/en/v2/Git-Tools-Submodules). That means, that the following things are contained within their own, external repository:

- `/kirby`: The actual Kirby CMS source
- `/content`: The website content
- `/site/plugins/*`: Many of the used Kirby plugins


## CI/CD

This repository is automatically deployed to [Uberspace](https://uberspace.de/) via GitHub Actions. Attention, the following files are not part of the deployment process and need to be copied/created manually:

- `/content`
- `/site/accounts`
- `/site/config`

## Local development setup
If you want to run this page locally for development purposes:

1. Clone this repository and include all submodules via
  ```
  git clone --recurse-submodules https://github.com/welcomewerkstatt/ww-site.git
  ```
  Attention: two submodules will fail to be cloned (`content/internes` and `content/inventar`) – this is fine (these repos are not public by default, please ask if you want to get access).
  
2. Use a local webserver with PHP 8 support and point it towards the base folder `ww-site` (e.g. on Mac Laravel Valet is a good server choice, on Windows take a look at MAMP)
3. Rename/copy the file `site/config/config.example.php` to `site/config/config.php`
