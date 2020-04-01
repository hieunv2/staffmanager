# Kaopiz's Laravel Base code

## Authentication
- Login using laravel multiple passport, with 2 separated type of auth for users and admin
- Read more at https://laravel.com/docs/5.7/passport and https://github.com/sfelix-martins/passport-multiauth

## Role and Permission
- Each user/admin may has 1 or many roles which allow them to access routes.
- Roles will be save in store and checked at client before access every route or checked by server before every api
- Read more at https://github.com/spatie/laravel-permission

## Admin page
- Based on https://github.com/PanJiaChen/vue-element-admin
- import mock.js to main.js to use mock api instead of restful
- Admin menu are generated from route with dynamical route for each admin role

## Admin UI library
- Using https://element.eleme.io

## List table screen
- Based on https://github.com/ratiw/vuetable-2
- Only need to config column and property to generate a complete table

## Resource API
- Based on laravel resource controller
- Have integrated a filter, sort params on a base controller
