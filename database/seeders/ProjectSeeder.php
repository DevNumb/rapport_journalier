<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $projects = [
            [
                'id' => 1,
                'ref' => 'Application web',
                'nom_projet' => 'Application web',
                'description' => null,
            ],
            [
                'id' => 2,
                'ref' => '319-17',
                'nom_projet' => '319-17 Etude de dépollution BV oued Majerda',
                'description' => null,
            ],
            [
                'id' => 20,
                'ref' => 'finance',
                'nom_projet' => 'finance',
                'description' => null,
            ],
            [
                'id' => 19,
                'ref' => 'comptable',
                'nom_projet' => 'comptable',
                'description' => null,
            ],
            [
                'id' => 16,
                'ref' => 'secretariat',
                'nom_projet' => 'secretariat',
                'description' => null,
            ],
            [
                'id' => 17,
                'ref' => 'Préparation offre',
                'nom_projet' => 'Préparation offre',
                'description' => null,
            ],
            [
                'id' => 88,
                'ref' => '381-24 SIGDIS',
                'nom_projet' => '381-24 SIGDIS',
                'description' => 'SIGDIS',
            ],
            [
                'id' => 7,
                'ref' => '301-15',
                'nom_projet' => '301-15-GKW_ONAS_STEP_Hammamet Sud',
                'description' => null,
            ],
            [
                'id' => 8,
                'ref' => '302-15',
                'nom_projet' => '302-15-GKW_Emissaire_HammametSud',
                'description' => null,
            ],
            [
                'id' => 9,
                'ref' => '303-15',
                'nom_projet' => '303-15-GKW_EIE_Eolienne_Benguerdene',
                'description' => null,
            ],
            [
                'id' => 10,
                'ref' => '309-16',
                'nom_projet' => '309-16-ANGED_CT_Lot1',
                'description' => null,
            ],
            [
                'id' => 87,
                'ref' => '380-24 SAFRAN GROMBALIA',
                'nom_projet' => '380-24 Etude Sol SAFRAN GROMBALIA',
                'description' => 'Etude Sol SAFRAN GROMBALIA',
            ],
            [
                'id' => 86,
                'ref' => '379-24 ABO WIND EIES',
                'nom_projet' => '379-24 ABO WIND EIES PV 100 MW',
                'description' => 'EIES PV 100 MW',
            ],
            [
                'id' => 18,
                'ref' => 'administration',
                'nom_projet' => 'administration',
                'description' => null,
            ],
            [
                'id' => 22,
                'ref' => '321-17',
                'nom_projet' => '321-17 assistance technique pour la mise oeuvre et le suivi du plan de gestion environnementale et sociale(PGES) des activités financées par le prêt additionnel de la banque mondiale',
                'description' => null,
            ],
            [
                'id' => 23,
                'ref' => '322-17',
                'nom_projet' => '322-17 Etude des aspects institutionnels et financiers de la gestion des eaux pluviales en milieu urbain',
                'description' => null,
            ],
            [
                'id' => 24,
                'ref' => 'Ressource humain',
                'nom_projet' => 'Ressource humain',
                'description' => null,
            ],
            [
                'id' => 25,
                'ref' => 'Export',
                'nom_projet' => 'Export',
                'description' => null,
            ],
            [
                'id' => 26,
                'ref' => 'Commercial',
                'nom_projet' => 'Commercial',
                'description' => null,
            ],
            [
                'id' => 27,
                'ref' => '324-18',
                'nom_projet' => '324-18 Etude d\'impact environnemental pour une unité industrielle de marbrerie au profitde l\'entreprise BEN Hamdouda Marbre',
                'description' => null,
            ],
            [
                'id' => 29,
                'ref' => '326-18',
                'nom_projet' => '326-18 Note priliminaire d\'impact de la Cité sportive de sfax',
                'description' => null,
            ],
            [
                'id' => 30,
                'ref' => '328-18',
                'nom_projet' => '328-18 EIE STEP Sousse hamdoun ONAS',
                'description' => null,
            ],
            [
                'id' => 32,
                'ref' => '331-18',
                'nom_projet' => '331-18 GKW_Adaptation EIE + PAR dess ...',
                'description' => null,
            ],
            [
                'id' => 83,
                'ref' => '376-23 EIE CPG Kef Eddour',
                'nom_projet' => '376-23 EIE CPG Kef Eddour',
                'description' => null,
            ],
            [
                'id' => 76,
                'ref' => '369-22',
                'nom_projet' => '369-22 EIE Lotissement Gafsa',
                'description' => null,
            ],
            [
                'id' => 72,
                'ref' => '366-21',
                'nom_projet' => '366-21 DEOP CITET',
                'nom_projet' => 'Diagnostic Environnemental Obl',
            ],
            [
                'id' => 84,
                'ref' => '377-23 SGES OMMP',
                'nom_projet' => '377-23 SGES OMMP',
                'description' => 'SGES OMMP',
            ],
            [
                'id' => 77,
                'ref' => '370-22',
                'nom_projet' => '370-22 PNUD AT déchets dangereux',
                'description' => null,
            ],
            [
                'id' => 74,
                'ref' => '368-21',
                'nom_projet' => '368-21 UTV Gafsa',
                'description' => null,
            ],
            [
                'id' => 81,
                'ref' => '374-23',
                'nom_projet' => '374-23 EIES PRSAEP CI',
                'description' => null,
            ],
            [
                'id' => 82,
                'ref' => '375-23',
                'nom_projet' => '375-23 PAR STEG',
                'description' => null,
            ],
            [
                'id' => 73,
                'ref' => '367-21',
                'nom_projet' => '367-21 EIES Quartier Balbala Djibouti',
                'description' => null,
            ],
            [
                'id' => 78,
                'ref' => '371-22',
                'nom_projet' => '371-22 ANAGED 3 décharges',
                'description' => null,
            ],
            [
                'id' => 53,
                'ref' => '344-19',
                'nom_projet' => '344-19 Etude de gestion VHU',
                'description' => null,
            ],
            [
                'id' => 54,
                'ref' => '345-19',
                'nom_projet' => '345-19 Eau 2050',
                'description' => null,
            ],
            [
                'id' => 55,
                'ref' => '347-19',
                'nom_projet' => '347-19 Etude d\'exécution CT Sidi El Hani',
                'description' => null,
            ],
            [
                'id' => 56,
                'ref' => '348-19',
                'nom_projet' => '348-19 PGCD Hammamet',
                'description' => null,
            ],
            [
                'id' => 57,
                'ref' => '352-20',
                'nom_projet' => '352-20 EP centre de stage Chaambi',
                'description' => null,
            ],
            [
                'id' => 58,
                'ref' => '353-20',
                'nom_projet' => '353-20 Etude réhabilitation décharge industrielle Menzel Bourguiba',
                'description' => null,
            ],
            [
                'id' => 79,
                'ref' => '372-22',
                'nom_projet' => '372-22 CPG Nafta Tozeur',
                'description' => null,
            ],
            [
                'id' => 85,
                'ref' => '378-23 SAFRAN Dhari',
                'nom_projet' => 'Etude sols SAFRAN DHARI',
                'description' => 'Etude sols SAFRAN DHARI',
            ],
            [
                'id' => 80,
                'ref' => '373-23',
                'nom_projet' => '373-23 ICU EIES unité valorisation déchets Nabeul',
                'description' => null,
            ],
            [
                'id' => 71,
                'ref' => '365-21',
                'nom_projet' => 'DGPC-PAR 7 gouv',
                'description' => 'PAR 7 gouvernorats',
            ],
            [
                'id' => 60,
                'ref' => '354-20',
                'nom_projet' => '354-20 Extension complexe sportif Sfax',
                'description' => 'Etude préliminaire d\'impact',
            ],
            [
                'id' => 61,
                'ref' => '355-20',
                'nom_projet' => '355-20 EIES emissaire Tunis Sud',
                'description' => 'EIES émissaire Tunis Sud Pour',
            ],
            [
                'id' => 62,
                'ref' => '356-20',
                'nom_projet' => '356-20 PGES PPI Ouled El May Bizerte',
                'description' => 'PGES PPI Ouled El May CRDA Biz',
            ],
            [
                'id' => 63,
                'ref' => '357-20',
                'nom_projet' => '357-20 EIE PPI EUT Téboursouk',
                'description' => 'EIE PPI eaux usées traitées de',
            ],
            [
                'id' => 64,
                'ref' => '358-20',
                'nom_projet' => '358-20 EIE préliminaire PV Mahres',
                'description' => 'EIE préliminaire de 2 projets',
            ],
            [
                'id' => 65,
                'ref' => '359-20',
                'nom_projet' => '359-20 Etude impact préliminaire station PV municipalité de Kébili',
                'description' => null,
            ],
            [
                'id' => 66,
                'ref' => '360-21',
                'nom_projet' => '362-21 PAR RN2',
                'description' => null,
            ],
            [
                'id' => 67,
                'ref' => '361-21',
                'nom_projet' => '361-21 Etude Oued tataouine Mun Tataouine',
                'description' => null,
            ],
            [
                'id' => 68,
                'ref' => '362-21',
                'nom_projet' => '362-21 EIES Unité de compostage à Mahdia',
                'description' => null,
            ],
            [
                'id' => 69,
                'ref' => '363-21',
                'nom_projet' => '363-21 CPG Etude des digues',
                'description' => null,
            ],
            [
                'id' => 70,
                'ref' => '364-21',
                'nom_projet' => '364-21 AFD Evaluation PNAQP4-2',
                'description' => null,
            ],
            [
                'id' => 89,
                'ref' => '382-24 CPG EIE Usine pilote',
                'nom_projet' => '382-24 CPG EIE Usine pilote',
                'description' => 'CPG EIE Usine pilote',
            ],
            [
                'id' => 90,
                'ref' => '383-24 SBT PI + EIE',
                'nom_projet' => '383-24 SBT PI + EIE',
                'description' => 'APS APD DAO + EIE',
            ],
            [
                'id' => 91,
                'ref' => '384-24 SAFRAN SOLIMAN',
                'nom_projet' => '384-24 Etude sol SAFRAN SOLIMAN',
                'description' => 'Etude sol SAFRAN SOLIMAN',
            ],
            [
                'id' => 92,
                'ref' => '385-24 GKW PNAQII EIES',
                'nom_projet' => '385-24 GKW PNAQII Mise à jour EIES Gafsa-ouest et SBZ',
                'description' => 'GKW PNAQII Mise à jour EIES Ga',
            ],
            [
                'id' => 93,
                'ref' => '388-24 GIZ',
                'nom_projet' => '388-24 Etude hydrologique site PV à Kébili',
                'description' => null,
            ],
            [
                'id' => 94,
                'ref' => '387-24 STEG EIES complémentai',
                'nom_projet' => '387-24 EIES complémentaire poste Skhira – STEG',
                'description' => '387-24 EIES ccomplémentaire',
            ],
            [
                'id' => 98,
                'ref' => '386-24 ONAS AT Sauvegardes E&S',
                'nom_projet' => '386-24 ONAS AT Sauvegardes E&S Lot 2 Sud',
                'description' => null,
            ],
            [
                'id' => 96,
                'ref' => '389-24 UTV Kef&Siliana',
                'nom_projet' => '389-24 UTV Kef&Siliana',
                'description' => '389-24 UTV Kef&Siliana',
            ],
            [
                'id' => 97,
                'ref' => '390-25 ME Inventaire rejets un',
                'nom_projet' => '390-25 ME Inventaire rejets unités industrielles polluantes',
                'description' => null,
            ],
        ];

        foreach ($projects as $projectData) {
            Project::create($projectData);
        }
    }
}
