module.exports = {
  base: '/openapi/',
  title: 'Laravel OpenAPI',
  description: 'Generate OpenAPI specification for Laravel Applications',
  themeConfig: {
    nav: [
      {text: 'Home', link: '/'},
      {text: 'GitHub', link: 'http://github.com/stonehilt/openapi'},
      {
        text: 'Packagist',
        link: 'https://packagist.org/packages/stonehilt/openapi',
      },
    ],
    sidebar: [
      '/',
      {
        title: 'Paths',
        collapsable: false,
        children: [
          '/paths/operations',
          '/paths/parameters',
          '/paths/request-bodies',
          '/paths/responses',
        ],
      },
      '/schemas',
      '/collections',
      '/middlewares',
      '/security'
    ],
    displayAllHeaders: true,
    sidebarDepth: 2,
  },
};
