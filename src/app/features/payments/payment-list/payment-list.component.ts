import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Router, RouterLink } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { PaymentService } from '../../../core/services/payment.service';
import { AuthService } from '../../../core/services/auth.service';

@Component({
  selector: 'app-payment-list',
  standalone: true,
  imports: [CommonModule, RouterLink, FormsModule],
  templateUrl: './payment-list.component.html',
  styleUrl: './payment-list.component.css',
})
export class PaymentListComponent implements OnInit {
  payments: any[] = [];
  loading = true;
  errorMessage = '';
  search = '';

  constructor(
    private paymentService: PaymentService,
    private authService: AuthService,
    private router: Router,
  ) {}

  ngOnInit(): void {
    this.loadPayments();
  }

  get totalPayments(): number {
    return this.payments.length;
  }

  get totalAmount(): number {
    return this.payments.reduce((sum, payment) => {
      return sum + Number(payment.iznos || 0);
    }, 0);
  }

  get lastPayment(): any {
    return this.payments.length > 0 ? this.payments[0] : null;
  }

  loadPayments(): void {
    this.loading = true;
    this.errorMessage = '';

    this.paymentService.getPayments(this.search).subscribe({
      next: (response) => {
        this.payments = response.data;
        this.loading = false;
      },
      error: () => {
        this.errorMessage = 'Greška pri učitavanju uplata.';
        this.loading = false;
      },
    });
  }

  searchPayments(): void {
    this.loadPayments();
  }

  resetSearch(): void {
    this.search = '';
    this.loadPayments();
  }

  logout(): void {
    this.authService.logout().subscribe({
      next: () => {
        this.router.navigate(['/login']);
      },
      error: () => {
        this.authService.clearSession();
        this.router.navigate(['/login']);
      },
    });
  }
}
