import { AsyncPipe, CommonModule, DatePipe } from '@angular/common';
import { RouterLink } from '@angular/router';
import { Observable } from 'rxjs';
import { Component, OnInit } from '@angular/core';
import { MatListModule } from '@angular/material/list';
import { Animal } from '../../model/animal';
import { AnimalService } from '../../services/animal.service';
import { MatButtonModule } from '@angular/material/button';
import { ObservationService } from '../../services/observation.service';
import { MatIconModule } from '@angular/material/icon';
import { MatToolbarModule } from '@angular/material/toolbar';
import { MatInputModule } from '@angular/material/input';
import { FormsModule } from '@angular/forms';
import { AuthenticationService } from '../../services/authentication.service';

@Component({
  selector: 'app-animals',
  standalone: true,
  templateUrl: './animals.component.html',
  styleUrl: './animals.component.scss',
  imports: [
    AsyncPipe, RouterLink, CommonModule,
    MatButtonModule, MatListModule, MatIconModule,
    MatToolbarModule, MatInputModule, FormsModule,
  ]
})
export class AnimalsComponent implements OnInit {
  animalsObs!: Observable<Animal[]>;
  admin: boolean = false;
  searchText: string = '';

  constructor(
    private animalService: AnimalService,
    private observationService: ObservationService,
    public auth: AuthenticationService
  ) { 
    this.admin = auth.roles.includes('ROLE_ADMIN');
  }

  ngOnInit() {
    this.animalsObs = this.animalService.all();
  }

  public delete(id: number) {
    this.animalService.delete(id).subscribe(() => window.location.reload());
  }
}
