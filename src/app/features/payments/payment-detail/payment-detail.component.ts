import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ActivatedRoute, RouterLink } from '@angular/router';
import { PaymentService } from '../../../core/services/payment.service';

@Component({
  selector: 'app-payment-detail',
  standalone: true,
  imports: [CommonModule, RouterLink],
  templateUrl: './payment-detail.component.html',
  styleUrl: './payment-detail.component.css',
})
export class PaymentDetailComponent implements OnInit {
  payment: any = null;
  loading = true;
  errorMessage = '';

  constructor(
    private route: ActivatedRoute,
    private paymentService: PaymentService,
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');

    if (!id) {
      this.errorMessage = 'Uplata nije pronađena.';
      this.loading = false;
      return;
    }

    this.paymentService.getPayment(id).subscribe({
      next: (response) => {
        this.payment = response.data;
        this.loading = false;
      },
      error: () => {
        this.errorMessage = 'Greška pri učitavanju detalja uplate.';
        this.loading = false;
      },
    });
  }
}
