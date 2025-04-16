<?php
namespace Tests;

use App\Models\Trajet;

class TrajetTest extends TestCase
{
    private $trajet;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->trajet = new Trajet();
    }
    
    public function testCreate()
    {
        // Créer des données de test (utilisateur et agences)
        $userId = $this->createTestUser();
        $agenceDepartId = $this->createTestAgence('Départ Test');
        $agenceArriveeId = $this->createTestAgence('Arrivée Test');
        
        // Données du trajet
        $data = [
            'date_depart' => '2025-05-10',
            'heure_depart' => '08:00:00',
            'date_arrivee' => '2025-05-10',
            'heure_arrivee' => '10:30:00',
            'places_total' => 4,
            'places_disponibles' => 4,
            'utilisateur_id' => $userId,
            'agence_depart_id' => $agenceDepartId,
            'agence_arrivee_id' => $agenceArriveeId
        ];
        
        // Créer le trajet
        $result = $this->trajet->create($data);
        
        // Vérifier que la création a réussi
        $this->assertTrue($result);
        
        // Vérifier que le trajet existe dans la base de données
        $stmt = $this->pdo->prepare("
            SELECT * FROM trajet 
            WHERE utilisateur_id = ? 
            AND agence_depart_id = ? 
            AND agence_arrivee_id = ?
        ");
        $stmt->execute([$userId, $agenceDepartId, $agenceArriveeId]);
        $trajet = $stmt->fetch();
        
        $this->assertNotFalse($trajet);
        $this->assertEquals('2025-05-10', $trajet->date_depart);
        $this->assertEquals('08:00:00', $trajet->heure_depart);
        $this->assertEquals(4, $trajet->places_total);
        $this->assertEquals(4, $trajet->places_disponibles);
    }
    
    public function testUpdate()
    {
        // Créer des données de test (utilisateur et agences)
        $userId = $this->createTestUser();
        $agenceDepartId = $this->createTestAgence('Départ Test');
        $agenceArriveeId = $this->createTestAgence('Arrivée Test');
        
        // Créer un trajet directement dans la base de données
        $stmt = $this->pdo->prepare("
            INSERT INTO trajet 
                (date_depart, heure_depart, date_arrivee, heure_arrivee, 
                places_total, places_disponibles, utilisateur_id, 
                agence_depart_id, agence_arrivee_id) 
            VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            '2025-05-10', '08:00:00', '2025-05-10', '10:30:00',
            4, 4, $userId, $agenceDepartId, $agenceArriveeId
        ]);
        $trajetId = $this->pdo->lastInsertId();
        
        // Données de mise à jour
        $data = [
            'date_depart' => '2025-05-11',
            'heure_depart' => '09:00:00',
            'date_arrivee' => '2025-05-11',
            'heure_arrivee' => '11:30:00',
            'places_total' => 3,
            'places_disponibles' => 3,
            'utilisateur_id' => $userId,
            'agence_depart_id' => $agenceDepartId,
            'agence_arrivee_id' => $agenceArriveeId
        ];
        
        // Mettre à jour le trajet
        $result = $this->trajet->update($trajetId, $data);
        
        // Vérifier que la mise à jour a réussi
        $this->assertTrue($result);
        
        // Vérifier que le trajet a été mis à jour
        $stmt = $this->pdo->prepare("SELECT * FROM trajet WHERE id = ?");
        $stmt->execute([$trajetId]);
        $trajet = $stmt->fetch();
        
        $this->assertEquals('2025-05-11', $trajet->date_depart);
        $this->assertEquals('09:00:00', $trajet->heure_depart);
        $this->assertEquals(3, $trajet->places_total);
        $this->assertEquals(3, $trajet->places_disponibles);
    }
    
    public function testDelete()
    {
        // Créer des données de test (utilisateur et agences)
        $userId = $this->createTestUser();
        $agenceDepartId = $this->createTestAgence('Départ Test');
        $agenceArriveeId = $this->createTestAgence('Arrivée Test');
        
        // Créer un trajet directement dans la base de données
        $stmt = $this->pdo->prepare("
            INSERT INTO trajet 
                (date_depart, heure_depart, date_arrivee, heure_arrivee, 
                places_total, places_disponibles, utilisateur_id, 
                agence_depart_id, agence_arrivee_id) 
            VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            '2025-05-10', '08:00:00', '2025-05-10', '10:30:00',
            4, 4, $userId, $agenceDepartId, $agenceArriveeId
        ]);
        $trajetId = $this->pdo->lastInsertId();
        
        // Supprimer le trajet
        $result = $this->trajet->delete($trajetId);
        
        // Vérifier que la suppression a réussi
        $this->assertTrue($result);
        
        // Vérifier que le trajet n'existe plus
        $stmt = $this->pdo->prepare("SELECT * FROM trajet WHERE id = ?");
        $stmt->execute([$trajetId]);
        $trajet = $stmt->fetch();
        
        $this->assertFalse($trajet);
    }
    
    public function testGetAvailableTrajets()
    {
        // Créer des données de test
        $userId = $this->createTestUser();
        $agenceDepartId = $this->createTestAgence('Départ Test');
        $agenceArriveeId = $this->createTestAgence('Arrivée Test');
        
        // Créer deux trajets : un avec des places disponibles, un sans
        $stmt = $this->pdo->prepare("
            INSERT INTO trajet 
                (date_depart, heure_depart, date_arrivee, heure_arrivee, 
                places_total, places_disponibles, utilisateur_id, 
                agence_depart_id, agence_arrivee_id) 
            VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        // Trajet avec places disponibles (futur)
        $futurDate = date('Y-m-d', strtotime('+10 days'));
        $stmt->execute([
            $futurDate, '08:00:00', $futurDate, '10:30:00',
            4, 2, $userId, $agenceDepartId, $agenceArriveeId
        ]);
        
        // Trajet sans places disponibles (futur)
        $stmt->execute([
            $futurDate, '09:00:00', $futurDate, '11:30:00',
            4, 0, $userId, $agenceDepartId, $agenceArriveeId
        ]);
        
        // Trajet passé (avec places)
        $pastDate = date('Y-m-d', strtotime('-10 days'));
        $stmt->execute([
            $pastDate, '08:00:00', $pastDate, '10:30:00',
            4, 2, $userId, $agenceDepartId, $agenceArriveeId
        ]);
        
        // Récupérer les trajets disponibles
        $availableTrajets = $this->trajet->getAvailableTrajets();
        
        // Vérifier qu'on a bien un seul trajet disponible (le premier)
        $this->assertCount(1, $availableTrajets);
        $this->assertEquals(2, $availableTrajets[0]->places_disponibles);
        $this->assertEquals($futurDate, $availableTrajets[0]->date_depart);
    }
}