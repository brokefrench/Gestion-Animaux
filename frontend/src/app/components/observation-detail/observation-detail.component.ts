import { Component, inject, OnInit, AfterViewInit, ViewChild, ElementRef, AfterViewChecked } from '@angular/core';
import { Observation } from '../../model/observation';
import { ActivatedRoute, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { RouterModule } from '@angular/router';
import { MatCardModule } from '@angular/material/card';
import { MatButtonModule } from '@angular/material/button';
import { AsyncPipe, CommonModule } from '@angular/common';
import { ObservationService } from '../../services/observation.service';
import { AnimalService } from '../../services/animal.service';
import { MatIcon } from '@angular/material/icon';
import { MatProgressSpinner } from '@angular/material/progress-spinner';
import { AuthenticationService } from '../../services/authentication.service';
import * as L from 'leaflet';

@Component({
  selector: 'app-observation-detail',
  imports: [CommonModule, RouterModule, MatCardModule, MatButtonModule, MatIcon, MatProgressSpinner, AsyncPipe],
  templateUrl: './observation-detail.component.html',
  styleUrl: './observation-detail.component.scss'
})
export class ObservationDetailComponent implements OnInit, AfterViewInit, AfterViewChecked {
  
  observationObs!: Observable<Observation>;
  route = inject(ActivatedRoute)
  private router = inject(Router);
  id!:number;
  @ViewChild('map') private mapContainer!: ElementRef;
  private map: L.Map | undefined;
  private mapInitialized = false;
  private observationData: Observation | null = null;

  constructor(private observationService: ObservationService,
    private animalService : AnimalService,public auth: AuthenticationService
  ) {     
    if(!auth.isAuthentified){
      this.router.navigate(['/login']);
    }
    delete (L.Icon.Default.prototype as any)._getIconUrl;
    L.Icon.Default.mergeOptions({
      iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
      iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
      shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    });
  }

  ngOnInit() {
    this.id = Number(this.route.snapshot.paramMap.get('idO'))
    this.observationObs = this.observationService.get(this.id)
    this.observationObs.subscribe(observation => {
      if(!this.auth.roles.includes('ROLE_ADMIN') && observation.user != '/api/users/'+this.auth.userid){
        this.router.navigate(['/animals'])
      }this.observationData = observation;
    })
  };

  ngAfterViewInit(): void {
  }

  ngAfterViewChecked(): void {
    if (this.observationData && this.mapContainer && !this.mapInitialized) {
      this.initMap();
      this.mapInitialized = true;
    }
  }

  public initMap(): void {
    if (!this.mapContainer) return;
    this.map = L.map(this.mapContainer.nativeElement, {
      center: [Number(this.observationData?.latitude), Number(this.observationData?.longitude)],
      zoom: 2
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(this.map);

    if (this.observationData) {
      L.marker([Number(this.observationData?.latitude), Number(this.observationData?.longitude)]).addTo(this.map)
        .bindPopup('Observation location')
        .openPopup();
    }
  }
}
