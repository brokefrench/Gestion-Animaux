import { Component, inject, OnInit } from '@angular/core';
import { Animal } from '../../model/animal';
import { AnimalService } from '../../services/animal.service';
import { ActivatedRoute, Router, RouterLink } from '@angular/router';
import { forkJoin, map, Observable, of, switchMap } from 'rxjs';
import { RouterModule } from '@angular/router';
import { MatCardModule } from '@angular/material/card';
import { MatButtonModule } from '@angular/material/button';
import { AsyncPipe, CommonModule } from '@angular/common';
import { ObservationService } from '../../services/observation.service';
import { Observation } from '../../model/observation';
import { MatIcon } from '@angular/material/icon';
import { MatProgressBar } from '@angular/material/progress-bar';
import { MatProgressSpinner } from '@angular/material/progress-spinner';
import { MatDivider } from '@angular/material/divider';
import { AuthenticationService } from '../../services/authentication.service';

@Component({
  selector: 'app-animal-detail',
  imports: [AsyncPipe,CommonModule, RouterModule, MatCardModule, MatButtonModule, RouterLink, MatIcon, MatProgressSpinner, MatDivider],
  templateUrl: './animal-detail.component.html',
  styleUrl: './animal-detail.component.scss'
})
export class AnimalDetailComponent implements OnInit{
  animalObs!: Observable<Animal>;
  observationObs!:Observable<Observation[]>;
  route = inject(ActivatedRoute)
  private router = inject(Router)
  user = "/api/users/"
  admin = false


  id!:number;
  recommendationObs!: Observable<Animal[]>;
  constructor(private animalService: AnimalService,
    private observationService : ObservationService,
    public auth: AuthenticationService
  ) {
    if(!auth.isAuthentified){
      this.router.navigate(['/animals']);
    }else{
      this.admin = auth.roles.includes('ROLE_ADMIN')
    }
    
  }

  ngOnInit() {
    this.id = Number(this.route.snapshot.paramMap.get('id'))
    this.animalObs = this.animalService.get(this.id);
    this.getObservationsByAnimal(this.animalObs, this.observationService)
    this.getRecco(this.animalService);
  }

  public delete(id: number){this.observationService.delete(id).subscribe(() => window.location.reload())}

  public getObservationsByAnimal(animalObs: Observable<Animal>, observationService: ObservationService) {
    this.observationObs = this.animalObs.pipe(
      switchMap((animal) => {
    
        if (animal && animal.observations && animal.observations.length > 0) {
    
          const requests = animal.observations.map((iri: string) => {
            const parts = iri.split('/');
            const id = Number(parts[3]);
            return this.observationService.get(id);
          });
    
          return forkJoin(requests);
        } else {
          return of([]);
        }
      })
    );
  } 

  public getRecco(animalService: AnimalService){
    this.recommendationObs = this.animalService.all().pipe(
      map((allAnimals) =>{
        return this.getRandomDifferentAnimals(allAnimals, this.id, 3);
      })
    )
  }
  private getRandomDifferentAnimals(allAnimals: Animal[], currentId: number | null, count: number): Animal[] {
    const differentAnimals = allAnimals.filter(animal => animal.id !== currentId);
    const shuffled = [...differentAnimals].sort(() => 0.5 - Math.random());
    return shuffled.slice(0, count);
  }
  
}
