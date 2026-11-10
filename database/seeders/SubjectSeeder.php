<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Contenu pédagogique de démonstration :
     * 3 matières → 2 chapitres chacune → 1 cours + 1 quiz par chapitre.
     * Chaque quiz contient 3 questions à 4 propositions (une seule correcte).
     */
    public function run(): void
    {
        foreach ($this->content() as $subjectData) {
            $subject = Subject::updateOrCreate(
                ['name' => $subjectData['name']],
                [
                    'description' => $subjectData['description'],
                    'color' => $subjectData['color'],
                    'icon' => $subjectData['icon'],
                    'is_active' => true,
                ]
            );

            foreach ($subjectData['chapters'] as $index => $chapterData) {
                $chapter = Chapter::updateOrCreate(
                    ['subject_id' => $subject->id, 'title' => $chapterData['title']],
                    [
                        'description' => $chapterData['description'],
                        'position' => $index + 1,
                    ]
                );

                Course::updateOrCreate(
                    ['chapter_id' => $chapter->id, 'title' => $chapterData['course']['title']],
                    [
                        'content' => $chapterData['course']['content'],
                        'position' => 1,
                    ]
                );

                $quiz = Quiz::updateOrCreate(
                    ['chapter_id' => $chapter->id, 'title' => $chapterData['quiz']['title']],
                    [
                        'description' => $chapterData['quiz']['description'],
                        'passing_score' => 50,
                        'is_published' => true,
                    ]
                );

                foreach ($chapterData['quiz']['questions'] as $questionIndex => $questionData) {
                    $question = Question::updateOrCreate(
                        ['quiz_id' => $quiz->id, 'question_text' => $questionData['text']],
                        [
                            'explanation' => $questionData['explanation'],
                            'points' => 1,
                            'position' => $questionIndex + 1,
                        ]
                    );

                    foreach ($questionData['answers'] as $answerIndex => $answerData) {
                        Answer::updateOrCreate(
                            ['question_id' => $question->id, 'answer_text' => $answerData['text']],
                            [
                                'is_correct' => $answerData['correct'],
                                'position' => $answerIndex + 1,
                            ]
                        );
                    }
                }
            }
        }
    }

    /**
     * Le contenu brut, séparé de la logique d'insertion pour rester lisible.
     */
    private function content(): array
    {
        return [
            [
                'name' => 'Algorithmique',
                'description' => 'Logique algorithmique, complexité et structures de données fondamentales.',
                'color' => '#5b7d9c',
                'icon' => 'bi-diagram-3',
                'chapters' => [
                    [
                        'title' => 'Complexité algorithmique',
                        'description' => 'Mesurer l\'efficacité d\'un algorithme indépendamment de la machine.',
                        'course' => [
                            'title' => 'Notation grand O et ordres de grandeur',
                            'content' => "La complexité décrit comment le temps d'exécution d'un algorithme évolue quand la taille des données d'entrée (notée n) augmente.\n\nOn utilise la notation grand O, qui donne une borne supérieure asymptotique : O(1) pour un temps constant, O(log n) pour une recherche dichotomique, O(n) pour un parcours linéaire, O(n log n) pour les bons algorithmes de tri, O(n²) pour les algorithmes à double boucle imbriquée.\n\nL'objectif est de choisir, pour un problème donné, l'algorithme dont la croissance reste supportable lorsque n devient grand. Un algorithme en O(n²) traite 1 000 éléments en un million d'opérations : c'est acceptable, puis inutilisable à 100 000 éléments.",
                        ],
                        'quiz' => [
                            'title' => 'Quiz — Complexité',
                            'description' => 'Vérifier la compréhension des ordres de grandeur.',
                            'questions' => [
                                [
                                    'text' => 'Que décrit la notation O(n) appliquée à un algorithme ?',
                                    'explanation' => 'Grand O décrit la croissance du coût (temps ou mémoire) en fonction de la taille des données, pas une durée exacte en secondes.',
                                    'answers' => [
                                        ['text' => 'La croissance du temps d\'exécution en fonction de la taille des données', 'correct' => true],
                                        ['text' => 'Le nombre exact de lignes de code de l\'algorithme', 'correct' => false],
                                        ['text' => 'La durée d\'exécution en secondes sur une machine donnée', 'correct' => false],
                                        ['text' => 'La quantité de mémoire du disque dur utilisée', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'Quelle est la complexité d\'un accès à un élément d\'un tableau par son indice ?',
                                    'explanation' => 'Le tableau stocke ses éléments de façon contiguë : l\'adresse se calcule directement, d\'où un temps constant O(1).',
                                    'answers' => [
                                        ['text' => 'O(1)', 'correct' => true],
                                        ['text' => 'O(n)', 'correct' => false],
                                        ['text' => 'O(log n)', 'correct' => false],
                                        ['text' => 'O(n²)', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'Quelle est la complexité de la recherche dichotomique dans un tableau trié ?',
                                    'explanation' => 'Chaque comparaison élimine la moitié des éléments restants : le nombre d\'étapes est logarithmique, soit O(log n).',
                                    'answers' => [
                                        ['text' => 'O(log n)', 'correct' => true],
                                        ['text' => 'O(n)', 'correct' => false],
                                        ['text' => 'O(1)', 'correct' => false],
                                        ['text' => 'O(n log n)', 'correct' => false],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'title' => 'Structures de données linéaires',
                        'description' => 'Piles, files et cas d\'usage concrets.',
                        'course' => [
                            'title' => 'Piles (LIFO) et files (FIFO)',
                            'content' => "Une pile fonctionne en LIFO (Last In, First Out) : le dernier élément empilé est le premier retiré. On l'utilise pour l'historique d'annulation, la récursivité ou l'évaluation d'expressions.\n\nUne file fonctionne en FIFO (First In, First Out) : le premier arrivé est le premier servi. Elle sert aux files d'attente, à l'ordonnancement de tâches et aux parcours en largeur d'un graphe.\n\nLes deux structures s'implémentent avec un tableau dynamique ou une liste chaînée ; le choix dépend surtout des opérations les plus fréquentes.",
                        ],
                        'quiz' => [
                            'title' => 'Quiz — Piles et files',
                            'description' => 'Distinguer les deux modes de fonctionnement.',
                            'questions' => [
                                [
                                    'text' => 'Quel principe décrit une pile ?',
                                    'explanation' => 'LIFO : le dernier élément ajouté est le premier retiré, comme une pile d\'assiettes.',
                                    'answers' => [
                                        ['text' => 'LIFO (dernier entré, premier sorti)', 'correct' => true],
                                        ['text' => 'FIFO (premier entré, premier sorti)', 'correct' => false],
                                        ['text' => 'Un accès aléatoire par indice', 'correct' => false],
                                        ['text' => 'Un tri automatique des éléments', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'Quelle structure choisir pour une file d\'attente de tâches ?',
                                    'explanation' => 'Une file d\'attente respecte l\'ordre d\'arrivée : c\'est le principe FIFO, donc une file (queue).',
                                    'answers' => [
                                        ['text' => 'Une file (FIFO)', 'correct' => true],
                                        ['text' => 'Une pile (LIFO)', 'correct' => false],
                                        ['text' => 'Un arbre binaire de recherche', 'correct' => false],
                                        ['text' => 'Une table de hachage', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'Quelle structure est la plus adaptée à un historique d\'annulation (undo) ?',
                                    'explanation' => 'Annuler revient à retirer la dernière action : c\'est exactement le comportement d\'une pile.',
                                    'answers' => [
                                        ['text' => 'Une pile', 'correct' => true],
                                        ['text' => 'Une file', 'correct' => false],
                                        ['text' => 'Un graphe orienté', 'correct' => false],
                                        ['text' => 'Un tableau trié', 'correct' => false],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],

            [
                'name' => 'Bases de données',
                'description' => 'Modélisation relationnelle, intégrité des données et requêtes SQL.',
                'color' => '#7f9cb6',
                'icon' => 'bi-database',
                'chapters' => [
                    [
                        'title' => 'Modèle relationnel',
                        'description' => 'Tables, clés et relations entre entités.',
                        'course' => [
                            'title' => 'Clés primaires et clés étrangères',
                            'content' => "Une table représente une entité (étudiant, matière, quiz). Chaque ligne doit pouvoir être identifiée de façon unique : c'est le rôle de la clé primaire, souvent un identifiant numérique auto-incrémenté.\n\nLa clé étrangère crée un lien vers la clé primaire d'une autre table. Elle matérialise la relation « un à plusieurs » : un chapitre appartient à une seule matière, mais une matière possède plusieurs chapitres (chapters.subject_id → subjects.id).\n\nL'intégrité référentielle empêche de créer un chapitre qui pointerait vers une matière inexistante, et permet de définir le comportement en cas de suppression (CASCADE, RESTRICT, SET NULL).",
                        ],
                        'quiz' => [
                            'title' => 'Quiz — Modèle relationnel',
                            'description' => 'Clés, relations et intégrité.',
                            'questions' => [
                                [
                                    'text' => 'Quelle est la fonction d\'une clé primaire ?',
                                    'explanation' => 'La clé primaire identifie chaque ligne de manière unique et ne peut pas être nulle.',
                                    'answers' => [
                                        ['text' => 'Identifier de façon unique chaque ligne d\'une table', 'correct' => true],
                                        ['text' => 'Afficher les données dans l\'ordre alphabétique', 'correct' => false],
                                        ['text' => 'Compter le nombre de colonnes', 'correct' => false],
                                        ['text' => 'Sauvegarder automatiquement la base', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'À quoi sert une clé étrangère ?',
                                    'explanation' => 'Une clé étrangère référence la clé primaire d\'une autre table : c\'est le support des relations et de l\'intégrité référentielle.',
                                    'answers' => [
                                        ['text' => 'À référencer la clé primaire d\'une autre table', 'correct' => true],
                                        ['text' => 'À chiffrer les données sensibles', 'correct' => false],
                                        ['text' => 'À créer un index de recherche plein texte', 'correct' => false],
                                        ['text' => 'À définir le type de données d\'une colonne', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'Une matière possède plusieurs chapitres. Quelle relation est-ce ?',
                                    'explanation' => 'Un chapitre n\'appartient qu\'à une matière, mais une matière regroupe plusieurs chapitres : c\'est une relation un-à-plusieurs.',
                                    'answers' => [
                                        ['text' => 'Un à plusieurs (1..N)', 'correct' => true],
                                        ['text' => 'Un à un (1..1)', 'correct' => false],
                                        ['text' => 'Plusieurs à plusieurs (N..N)', 'correct' => false],
                                        ['text' => 'Aucune relation', 'correct' => false],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'title' => 'Requêtes SQL',
                        'description' => 'Sélection, filtrage et jointures.',
                        'course' => [
                            'title' => 'SELECT, WHERE et JOIN',
                            'content' => "SELECT choisit les colonnes à retourner ; FROM indique la table source ; WHERE filtre les lignes ; ORDER BY trie le résultat ; LIMIT limite le nombre de lignes.\n\nUne jointure combine deux tables sur une condition : INNER JOIN ne garde que les lignes présentes des deux côtés, LEFT JOIN conserve toutes les lignes de gauche même sans correspondance.\n\nExemple : lister les quiz d'une matière revient à joindre subjects → chapters → quizzes sur les clés étrangères, puis à filtrer sur subjects.name.",
                        ],
                        'quiz' => [
                            'title' => 'Quiz — SQL',
                            'description' => 'Clauses et jointures essentielles.',
                            'questions' => [
                                [
                                    'text' => 'Quelle clause filtre les lignes avant l\'agrégation ?',
                                    'explanation' => 'WHERE filtre les lignes individuelles ; HAVING s\'applique après GROUP BY, sur les groupes agrégés.',
                                    'answers' => [
                                        ['text' => 'WHERE', 'correct' => true],
                                        ['text' => 'ORDER BY', 'correct' => false],
                                        ['text' => 'LIMIT', 'correct' => false],
                                        ['text' => 'SELECT', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'Que fait un INNER JOIN ?',
                                    'explanation' => 'INNER JOIN ne conserve que les lignes ayant une correspondance dans les deux tables jointes.',
                                    'answers' => [
                                        ['text' => 'Il ne conserve que les lignes qui ont une correspondance dans les deux tables', 'correct' => true],
                                        ['text' => 'Il conserve toutes les lignes de la table de gauche', 'correct' => false],
                                        ['text' => 'Il supprime les doublons de la table de droite', 'correct' => false],
                                        ['text' => 'Il crée une copie de la table', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'Quelle clause permet de trier un résultat ?',
                                    'explanation' => 'ORDER BY trie selon une ou plusieurs colonnes, avec ASC (défaut) ou DESC.',
                                    'answers' => [
                                        ['text' => 'ORDER BY', 'correct' => true],
                                        ['text' => 'GROUP BY', 'correct' => false],
                                        ['text' => 'WHERE', 'correct' => false],
                                        ['text' => 'UPDATE', 'correct' => false],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],

            [
                'name' => 'Développement web',
                'description' => 'HTML, CSS et architecture MVC avec Laravel et Blade.',
                'color' => '#6a8ba3',
                'icon' => 'bi-code-slash',
                'chapters' => [
                    [
                        'title' => 'Bases du web',
                        'description' => 'Structure HTML et présentation CSS.',
                        'course' => [
                            'title' => 'HTML sémantique et CSS responsive',
                            'content' => "Le HTML décrit la structure et le sens du contenu : en-têtes, paragraphes, listes, formulaires, sections. Utiliser les balises sémantiques (header, nav, main, aside, footer) améliore l'accessibilité et le référencement.\n\nLe CSS gère la présentation : couleurs, espacements, typographie, disposition. Les media queries adaptent l'affichage à la taille de l'écran, principe de base du responsive design.\n\nBootstrap 5 fournit une grille de 12 colonnes et des composants prêts à l'emploi ; on le personnalise avec ses propres variables CSS plutôt que de réécrire chaque style.",
                        ],
                        'quiz' => [
                            'title' => 'Quiz — HTML et CSS',
                            'description' => 'Rôles respectifs des deux langages.',
                            'questions' => [
                                [
                                    'text' => 'Quel est le rôle principal du HTML ?',
                                    'explanation' => 'HTML structure et donne du sens au contenu ; la mise en forme est confiée au CSS.',
                                    'answers' => [
                                        ['text' => 'Structurer le contenu de la page', 'correct' => true],
                                        ['text' => 'Mettre en forme les couleurs et les polices', 'correct' => false],
                                        ['text' => 'Gérer les requêtes vers la base de données', 'correct' => false],
                                        ['text' => 'Compiler le code PHP', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'À quoi sert une media query en CSS ?',
                                    'explanation' => 'Les media queries appliquent des styles selon les caractéristiques de l\'écran, ce qui rend l\'interface responsive.',
                                    'answers' => [
                                        ['text' => 'Adapter les styles à la taille de l\'écran', 'correct' => true],
                                        ['text' => 'Charger une image plus lourde', 'correct' => false],
                                        ['text' => 'Créer une table MySQL', 'correct' => false],
                                        ['text' => 'Valider un formulaire côté serveur', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'Combien de colonnes compte la grille de Bootstrap 5 ?',
                                    'explanation' => 'La grille Bootstrap est découpée en 12 colonnes, ce qui permet des combinaisons comme 4/8 ou 3/6/3.',
                                    'answers' => [
                                        ['text' => '12', 'correct' => true],
                                        ['text' => '8', 'correct' => false],
                                        ['text' => '16', 'correct' => false],
                                        ['text' => '24', 'correct' => false],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'title' => 'Laravel et le pattern MVC',
                        'description' => 'Séparer les responsabilités dans une application PHP.',
                        'course' => [
                            'title' => 'Comprendre le MVC de Laravel',
                            'content' => "Le modèle MVC sépare trois responsabilités. Le Model encapsule les données et les règles métier (relations Eloquent, requêtes). La View affiche : avec Laravel, ce sont les templates Blade. Le Controller reçoit la requête, décide quoi faire, interroge les modèles et renvoie une vue ou une redirection.\n\nLe routeur (routes/web.php) associe une URL à une action de contrôleur. Les migrations versionnent le schéma de la base : elles permettent de recréer la structure sur n'importe quelle machine avec php artisan migrate.\n\nCette séparation rend le code testable et maintenable : on peut modifier l'affichage sans toucher à la logique métier.",
                        ],
                        'quiz' => [
                            'title' => 'Quiz — Architecture MVC',
                            'description' => 'Rôle de chaque couche.',
                            'questions' => [
                                [
                                    'text' => 'Dans le MVC, quel composant contient la logique de traitement ?',
                                    'explanation' => 'Le Controller orchestre : il valide, appelle les modèles et choisit la vue à retourner.',
                                    'answers' => [
                                        ['text' => 'Le contrôleur', 'correct' => true],
                                        ['text' => 'La vue', 'correct' => false],
                                        ['text' => 'La migration', 'correct' => false],
                                        ['text' => 'La feuille de style', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'Quel est le rôle des templates Blade ?',
                                    'explanation' => 'Blade est le moteur de templates de Laravel : il génère le HTML à partir des données fournies par le contrôleur.',
                                    'answers' => [
                                        ['text' => 'Générer le HTML affiché à partir des données', 'correct' => true],
                                        ['text' => 'Créer les tables de la base de données', 'correct' => false],
                                        ['text' => 'Stocker les mots de passe', 'correct' => false],
                                        ['text' => 'Définir les routes de l\'application', 'correct' => false],
                                    ],
                                ],
                                [
                                    'text' => 'À quoi servent les migrations Laravel ?',
                                    'explanation' => 'Les migrations décrivent le schéma en PHP : elles permettent de le versionner et de le recréer à l\'identique.',
                                    'answers' => [
                                        ['text' => 'À versionner et recréer la structure de la base de données', 'correct' => true],
                                        ['text' => 'À importer des images depuis le navigateur', 'correct' => false],
                                        ['text' => 'À minifier le CSS', 'correct' => false],
                                        ['text' => 'À envoyer des e-mails', 'correct' => false],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
