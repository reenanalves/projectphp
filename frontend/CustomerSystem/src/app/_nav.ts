import { INavData } from '@coreui/angular';

export const navItems: INavData[] = [
  {
    title: true,
    name: 'Menu'
  },
  {
    name: 'Cliente',
    url: '/buttons',
    icon: 'cui-people',
    children: [
      {
        name: 'Clientes',
        icon: 'cui-list',
        url: '/customers'
      },
      {
        name: 'Novo Cliente',
        icon: 'cui-user-follow',
        url: '/customer'
      }
    ]
  }
];
