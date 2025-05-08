import { Routes } from '@angular/router';
import { AboutComponent } from './about/about.component';
import { AnimalsComponent } from './components/animals/animals.component';
import { AnimalDetailComponent } from './components/animal-detail/animal-detail.component';
import { AnimalFormComponent } from './components/animal-form/animal-form.component';
import { ObservationDetailComponent } from './components/observation-detail/observation-detail.component';
import { ObservationFormComponent } from './components/observation-form/observation-form.component';
import { LoginComponent } from './components/login/login.component';
import { RegistrationComponent } from './components/registration/registration.component';
import { QuizComponent } from './components/quiz/quiz.component';

export const routes: Routes = [
    { path: 'about', component: AboutComponent },
    { path: 'animals', component: AnimalsComponent},
    { path: 'animals/:id', component: AnimalDetailComponent},
    { path: 'edit-animal/:id', component: AnimalFormComponent},
    { path: 'add-animal', component: AnimalFormComponent},
    { path: 'animals/:idAnimal/observation/:idO', component: ObservationDetailComponent},
    { path: 'edit-observation/:id', component: ObservationFormComponent},
    { path: 'animals/:idA/add-observation', component: ObservationFormComponent},
    { path: 'login', component: LoginComponent},    
    { path: 'registration', component: RegistrationComponent},
    { path: 'quiz', component: QuizComponent}
];
