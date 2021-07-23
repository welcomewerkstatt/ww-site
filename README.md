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
