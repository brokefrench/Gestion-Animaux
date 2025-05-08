import { CommonModule } from '@angular/common';
import { Component, inject } from '@angular/core';
import {
  FormBuilder,
  FormGroup,
  ReactiveFormsModule,
  Validators,
} from '@angular/forms';
import { MatButtonModule } from '@angular/material/button';
import { MatCardModule } from '@angular/material/card';
import { MatFormFieldModule } from '@angular/material/form-field';
import { MatInputModule } from '@angular/material/input';
import { ActivatedRoute, Router, RouterModule } from '@angular/router';
import { ObservationService } from '../../services/observation.service';
import { MatIcon } from '@angular/material/icon';
import { AuthenticationService } from '../../services/authentication.service';

@Component({
  selector: 'app-observation-form',
  standalone: true,
  imports: [
    CommonModule,
    ReactiveFormsModule,
    RouterModule,
    MatFormFieldModule,
    MatInputModule,
    MatButtonModule,
    MatCardModule,
    MatIcon
  ],
  templateUrl: './observation-form.component.html',
})
export class ObservationFormComponent {
  private fb = inject(FormBuilder);
  private route = inject(ActivatedRoute);
  private observationService = inject(ObservationService);
  private router = inject(Router);

  id = Number(this.route.snapshot.paramMap.get('id'));
  isEditing = this.id > 0;

  form: FormGroup = this.fb.group({
    id: [''],
    date: ['', Validators.required],
    latitude: ['', [Validators.required]],
    longitude: ['', [Validators.required]],
    description: ['', Validators.required],
    idAnimal: [''],
    user: ['']
  });

  constructor(public auth: AuthenticationService) {
    if(!auth.isAuthentified){
      this.router.navigate(['/login']);
    }
    if (this.isEditing) {
      this.observationService
        .get(this.id)
        .subscribe((observation) => {
          if(observation.user != '/api/users/'+auth.userid && !auth.roles.includes('ROLE_ADMIN')){
            this.router.navigate(['/animals']);
          }
          const formattedDate = observation.date.slice(0, 16);
  
          this.form.patchValue({
            id: observation.id,
            date: formattedDate,
            latitude: observation.latitude,
            longitude: observation.longitude,
            description: observation.description,
            idAnimal: observation.idAnimal,
          });
        });
    }
  }

  onSubmit(): void {
    const data = this.form.value;
    data.latitude = Number(data.latitude)
    data.longitude = Number(data.longitude)

    if (this.isEditing) {
      data.id = this.id;
      data.user = "/api/users/"+this.auth.userid.toString()
      this.observationService
        .update(data)
        .subscribe(() => this.router.navigate(['/animals']));
    } else {
      data.id = 0
      data.user = "/api/users/"+this.auth.userid.toString()
      data.idAnimal = "/api/animals/"+(this.route.snapshot.paramMap.get('idA'))
      this.observationService
        .create(data)
        .subscribe(() => this.router.navigate(['/animals']));
    }
  }
}