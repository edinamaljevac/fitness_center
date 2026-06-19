import { Routes } from '@angular/router';

import { LoginComponent } from './features/login/login.component';
import { PaymentListComponent } from './features/payments/payment-list/payment-list.component';
import { PaymentCreateComponent } from './features/payments/payment-create/payment-create.component';
import { PaymentDetailComponent } from './features/payments/payment-detail/payment-detail.component';
import { authGuard } from './core/guards/auth.guard';

export const routes: Routes = [
  {
    path: '',
    redirectTo: 'login',
    pathMatch: 'full',
  },

  {
    path: 'login',
    component: LoginComponent,
  },

  {
    path: 'payments',
    component: PaymentListComponent,
    canActivate: [authGuard],
  },

  {
    path: 'payments/create',
    component: PaymentCreateComponent,
    canActivate: [authGuard],
  },

  {
    path: 'payments/:id',
    component: PaymentDetailComponent,
    canActivate: [authGuard],
  },

  {
    path: '**',
    redirectTo: 'login',
  },
];
