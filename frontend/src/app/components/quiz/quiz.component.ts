import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { MatCardModule } from '@angular/material/card';
import { MatButtonModule } from '@angular/material/button';
import { MatListModule } from '@angular/material/list';
@Component({
  selector: 'app-quiz',
  standalone: true,
  templateUrl: './quiz.component.html',
  imports: [
    MatCardModule,
    MatButtonModule,
    MatListModule,
  ],
})
export class QuizComponent implements OnInit {
  question = '';
  choices: string[] = [];
  correct = '';
  selectedChoice: string | null = null;
  showAnswer = false;
  streak = 0;

  constructor(private http: HttpClient) {}

  ngOnInit(): void {
    this.loadQuestion();
  }

  loadQuestion(): void {
    this.http.get<any>('http://localhost:8082/api/quiz-question').subscribe(data => {
      this.question = data.question;
      this.choices = data.choices;
      this.correct = data.correct;
      this.selectedChoice = null;
      this.showAnswer = false;
    });
  }

  selectChoice(choice: string): void {
    this.selectedChoice = choice;
    this.showAnswer = true;
  }

  playAgain(): void {
    if(this.selectedChoice == this.correct){
      this.streak ++
    }
    else{
      this.streak = 0;
    }
    this.loadQuestion();
  }
}
