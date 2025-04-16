<?php
namespace Tests;

use App\Models\Agence;

class AgenceTest extends TestCase
{
    private $agence;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->agence = new Agence();
    }
    
    public function testCreate()
    {
        // Créer une nouvelle agence
        $data = ['nom' => 'Paris Test'];
        $result = $this->agence->create($data);
        
        // Vérifier que la création a réussi
        $this->assertTrue($result);
        
        // Vérifier que l'agence existe dans la base de données
        $stmt = $this->pdo->prepare("SELECT * FROM agence WHERE nom = ?");
        $stmt->execute(['Paris Test']);
        $agence = $stmt->fetch();
        
        $this->assertNotFalse($agence);
        $this->assertEquals('Paris Test', $agence->nom);
    }
    
    public function testUpdate()
    {
        // Créer une agence de test
        $agenceId = $this->createTestAgence('Lyon Test');
        
        // Mettre à jour l'agence
        $data = ['nom' => 'Lyon Updated'];
        $result = $this->agence->update($agenceId, $data);
        
        // Vérifier que la mise à jour a réussi
        $this->assertTrue($result);
        
        // Vérifier que l'agence a été mise à jour
        $stmt = $this->pdo->prepare("SELECT * FROM agence WHERE id = ?");
        $stmt->execute([$agenceId]);
        $agence = $stmt->fetch();
        
        $this->assertEquals('Lyon Updated', $agence->nom);
    }
    
    public function testDelete()
    {
        // Créer une agence de test
        $agenceId = $this->createTestAgence('Marseille Test');
        
        // Supprimer l'agence
        $result = $this->agence->delete($agenceId);
        
        // Vérifier que la suppression a réussi
        $this->assertTrue($result);
        
        // Vérifier que l'agence n'existe plus
        $stmt = $this->pdo->prepare("SELECT * FROM agence WHERE id = ?");
        $stmt->execute([$agenceId]);
        $agence = $stmt->fetch();
        
        $this->assertFalse($agence);
    }
}