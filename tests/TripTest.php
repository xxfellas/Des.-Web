<?php

use PHPUnit\Framework\TestCase;
use App\Models\Trip;


class TripTest extends TestCase
{
    public function testTripCreation()
    {
        // Cria uma nova instância de Trip com dados de exemplo
        $trip = new Trip("Rio de Janeiro", 7);
        
        // Testa se o destino é o esperado
        $this->assertEquals("Rio de Janeiro", $trip->getDestination());
        
        // Testa se a duração é a esperada
        $this->assertEquals(7, $trip->getDuration());
    }

    public function testAddingExpenseToTrip()
    {
        // Cria uma instância de Trip
        $trip = new Trip("São Paulo", 3);
        
        // Adiciona uma despesa e verifica se ela foi adicionada corretamente
        $trip->addExpense("Alimentação", 150);
        $expenses = $trip->getExpenses();
        
        // Verifica se o número de despesas é o esperado
        $this->assertCount(1, $expenses);
        
        // Verifica se a primeira despesa está correta
        $this->assertEquals("Alimentação", $expenses[0]->getDescription());
        $this->assertEquals(150, $expenses[0]->getAmount());
    }
}
