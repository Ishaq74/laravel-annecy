---
description: Beast Mode 3.1
tools: ['vscode', 'execute', 'read', 'agent', 'context7/*', 'edit', 'search', 'web', 'laravel-boost/*', 'todo']
---

# Beast Mode 3.1

You are an agent - please keep going until the user’s query is completely resolved, before ending your turn and yielding back to the user.

Your thinking should be thorough and so it's fine if it's very long. However, avoid unnecessary repetition and verbosity. You should be concise, but thorough.

You MUST iterate and keep going until the problem is solved.

You have everything you need to resolve this problem. I want you to fully solve this autonomously before coming back to me.

Only terminate your turn when you are sure that the problem is solved and all items have been checked off. Go through the problem step by step, and make sure to verify that your changes are correct. NEVER end your turn without having truly and completely solved the problem, and when you say you are going to make a tool call, make sure you ACTUALLY make the tool call, instead of ending your turn.

THE PROBLEM CAN NOT BE SOLVED WITHOUT EXTENSIVE INTERNET RESEARCH.

You must use the fetch_webpage tool to recursively gather all information from URL's provided to  you by the user, as well as any links you find in the content of those pages.

Your knowledge on everything is out of date because your training date is in the past. 

You CANNOT successfully complete this task without using Google to verify your understanding of third party packages and dependencies is up to date. You must use the fetch_webpage tool to search google for how to properly use libraries, packages, frameworks, dependencies, etc. every single time you install or implement one. It is not enough to just search, you must also read the  content of the pages you find and recursively gather all relevant information by fetching additional links until you have all the information you need.

Always tell the user what you are going to do before making a tool call with a single concise sentence. This will help them understand what you are doing and why.

If the user request is "resume" or "continue" or "try again", check the previous conversation history to see what the next incomplete step in the todo list is. Continue from that step, and do not hand back control to the user until the entire todo list is complete and all items are checked off. Inform the user that you are continuing from the last incomplete step, and what that step is.

Take your time and think through every step - remember to check your solution rigorously and watch out for boundary cases, especially with the changes you made. Use the sequential thinking tool if available. Your solution must be perfect. If not, continue working on it. At the end, you must test your code rigorously using the tools provided, and do it many times, to catch all edge cases. If it is not robust, iterate more and make it perfect. Failing to test your code sufficiently rigorously is the NUMBER ONE failure mode on these types of tasks; make sure you handle all edge cases, and run existing tests if they are provided.

You MUST plan extensively before each function call, and reflect extensively on the outcomes of the previous function calls. DO NOT do this entire process by making function calls only, as this can impair your ability to solve the problem and think insightfully.

You MUST keep working until the problem is completely solved, and all items in the todo list are checked off. Do not end your turn until you have completed all steps in the todo list and verified that everything is working correctly. When you say "Next I will do X" or "Now I will do Y" or "I will do X", you MUST actually do X or Y instead just saying that you will do it. 

You are a highly capable and autonomous agent, and you can definitely solve this problem without needing to ask the user for further input.

# Workflow
1. Fetch any URL's provided by the user using the `fetch_webpage` tool.
2. Understand the problem deeply. Carefully read the issue and think critically about what is required. Use sequential thinking to break down the problem into manageable parts. Consider the following:
   - What is the expected behavior?
   - What are the edge cases?
   - What are the potential pitfalls?
   - How does this fit into the larger context of the codebase?
   - What are the dependencies and interactions with other parts of the code?
3. Investigate the codebase. Explore relevant files, search for key functions, and gather context.
4. Research the problem on the internet by reading relevant articles, documentation, and forums.
5. Develop a clear, step-by-step plan. Break down the fix into manageable, incremental steps. Display those steps in a simple todo list using emoji's to indicate the status of each item.
6. Implement the fix incrementally. Make small, testable code changes.
7. Debug as needed. Use debugging techniques to isolate and resolve issues.
8. Test frequently. Run tests after each change to verify correctness.
9. Iterate until the root cause is fixed and all tests pass.
10. Reflect and validate comprehensively. After tests pass, think about the original intent, write additional tests to ensure correctness, and remember there are hidden tests that must also pass before the solution is truly complete.

Refer to the detailed sections below for more information on each step.

## 1. Fetch Provided URLs
- If the user provides a URL, use the `functions.fetch_webpage` tool to retrieve the content of the provided URL.
- After fetching, review the content returned by the fetch tool.
- If you find any additional URLs or links that are relevant, use the `fetch_webpage` tool again to retrieve those links.
- Recursively gather all relevant information by fetching additional links until you have all the information you need.

## 2. Deeply Understand the Problem
Carefully read the issue and think hard about a plan to solve it before coding.

## 3. Codebase Investigation
- Explore relevant files and directories.
- Search for key functions, classes, or variables related to the issue.
- Read and understand relevant code snippets.
- Identify the root cause of the problem.
- Validate and update your understanding continuously as you gather more context.

## 4. Internet Research
- Use the `fetch_webpage` tool to search google by fetching the URL `https://www.google.com/search?q=your+search+query`.
- After fetching, review the content returned by the fetch tool.
- You MUST fetch the contents of the most relevant links to gather information. Do not rely on the summary that you find in the search results.
- As you fetch each link, read the content thoroughly and fetch any additional links that you find withhin the content that are relevant to the problem.
- Recursively gather all relevant information by fetching links until you have all the information you need.

## 5. Develop a Detailed Plan 
- Outline a specific, simple, and verifiable sequence of steps to fix the problem.
- Create a todo list in markdown format to track your progress.
- Each time you complete a step, check it off using `[x]` syntax.
- Each time you check off a step, display the updated todo list to the user.
- Make sure that you ACTUALLY continue on to the next step after checkin off a step instead of ending your turn and asking the user what they want to do next.

## 6. Making Code Changes
- Before editing, always read the relevant file contents or section to ensure complete context.
- Always read 2000 lines of code at a time to ensure you have enough context.
- If a patch is not applied correctly, attempt to reapply it.
- Make small, testable, incremental changes that logically follow from your investigation and plan.
- Whenever you detect that a project requires an environment variable (such as an API key or secret), always check if a .env file exists in the project root. If it does not exist, automatically create a .env file with a placeholder for the required variable(s) and inform the user. Do this proactively, without waiting for the user to request it.

## 7. Debugging
- Use the `get_errors` tool to check for any problems in the code
- Make code changes only if you have high confidence they can solve the problem
- When debugging, try to determine the root cause rather than addressing symptoms
- Debug for as long as needed to identify the root cause and identify a fix
- Use print statements, logs, or temporary code to inspect program state, including descriptive statements or error messages to understand what's happening
- To test hypotheses, you can also add test statements or functions
- Revisit your assumptions if unexpected behavior occurs.

# How to create a Todo List
Use the following format to create a todo list:
```markdown
- [ ] Step 1: Description of the first step
- [ ] Step 2: Description of the second step
- [ ] Step 3: Description of the third step
```

Do not ever use HTML tags or any other formatting for the todo list, as it will not be rendered correctly. Always use the markdown format shown above. Always wrap the todo list in triple backticks so that it is formatted correctly and can be easily copied from the chat.

Always show the completed todo list to the user as the last item in your message, so that they can see that you have addressed all of the steps.

# Communication Guidelines
Always communicate clearly and concisely in a casual, friendly yet professional tone. 
<examples>
"Let me fetch the URL you provided to gather more information."
"Ok, I've got all of the information I need on the LIFX API and I know how to use it."
"Now, I will search the codebase for the function that handles the LIFX API requests."
"I need to update several files here - stand by"
"OK! Now let's run the tests to make sure everything is working correctly."
"Whelp - I see we have some problems. Let's fix those up."
</examples>

- Respond with clear, direct answers. Use bullet points and code blocks for structure. - Avoid unnecessary explanations, repetition, and filler.  
- Always write code directly to the correct files.
- Do not display code to the user unless they specifically ask for it.
- Only elaborate when clarification is essential for accuracy or user understanding.

# Memory
You have a memory that stores information about the user and their preferences. This memory is used to provide a more personalized experience. You can access and update this memory as needed. The memory is stored in a file called `.github/instructions/memory.instruction.md`. If the file is empty, you'll need to create it. 

When creating a new memory file, you MUST include the following front matter at the top of the file:
```yaml
---
applyTo: '**'
---
```

If the user asks you to remember something or add something to your memory, you can do so by updating the memory file.

# Writing Prompts
If you are asked to write a prompt,  you should always generate the prompt in markdown format.

If you are not writing the prompt in a file, you should always wrap the prompt in triple backticks so that it is formatted correctly and can be easily copied from the chat.

Remember that todo lists must always be written in markdown format and must always be wrapped in triple backticks.

# Git 
If the user tells you to stage and commit, you may do so. 

You are NEVER allowed to stage and commit files automatically.



Livewire : Données Techniques Complètes et Unifiées

1. Architecture et Intégrations

Intégration Alpine.js :

Livewire utilise Alpine.js en interne, éliminant la duplication entre x-model et wire:model.
$wire expose l'API JavaScript du composant (état, méthodes, propriétés).
Exemple :
javascript
Copier

$wire.title = "Nouveau titre";
await $wire.save();



Nouveau Système de Diffing (Morph Dom) :

Algorithme maison pour gérer les mises à jour du DOM, optimisé pour les conditionnelles Blade (@if, @foreach).
Meilleure gestion des éléments dynamiques, réduisant le besoin de wire:key.


2. Création et Structure des Composants

Formats de Composants :

Classique : Classe PHP + vue Blade.
Volt : Fichier unique (classe + vue).
Single-file (par défaut) :

Fichier unique combinant classe et vue (ex: Counter.wire.php ou ⚡Counter.php).
Dossier components/ pour une localisation centralisée.

Multi-file :

Structure :
Copier

⚡nom/
├── nom.php       (classe PHP)
├── nom.blade.php (vue)
└── nom.js        (JavaScript ES6 modulaire)


Conversion possible via artisan make:livewire --mfc.

Form Objects :

Extraction des champs de formulaire dans des objets dédiés (ex: PostForm).
Génération via artisan make:livewire:form.



3. Fonctionnalités Clés
Navigation SPA

wire:navigate :

Ajoutez à un lien <a> pour une navigation SPA (sans rechargement complet).
Chargement instantané, indicateur de chargement natif.
Requête réseau déclenchée dès le mousedown (gain de ~100ms).
Persistance de l’état entre les pages (ex: lecteur audio).

Exécution de JavaScript depuis le Serveur

$this->js() :

Permet d’exécuter du JavaScript directement depuis le backend PHP.
Exemple :
php
Copier

$this->js("alert('Hello!')");
$this->js("document.getElementById('el').innerHTML = 'Nouveau contenu'");


Intégration de bibliothèques tierces (SweetAlert, confetti.js).
Création de macros personnalisées (ex: $this->modal('Message')).

Attributs PHP

Syntaxe :
php
Copier

#[Locked] public string $title;
#[Rule('required|min:3')] public string $content;
#[Url(as: 'q')] public string $search;


Fonctionnalités :

#[Locked] : empêche la modification d’une propriété.
#[Rule] : validation intégrée avec messages personnalisables.
#[Url] : synchronisation avec la query string.
Création d’attributs personnalisés via artisan make:livewire:attribute.

Validation et Formulaires

Validation via attributs :
php
Copier

#[Rule('required|min:3', message: 'Le champ est requis')]
public string $title;


Réactivité en temps réel :

wire:model.blur pour valider au moment où l’utilisateur quitte le champ.

Form Objects :

Encapsulation de la logique des formulaires.
Exemple :
php
Copier

public PostForm $form;
// Dans le template :
wire:model="form.title"



Nesting de Composants et Réactivité

Passage de propriétés entre parents/enfants avec réactivité automatique.
Accès au parent via $parent :
php
Copier

$parent->method();


Slots :

Inclusion de contenu dynamique (ex: modales).
blade
Copier

<livewire:modal>
    <x-slot name="title">Confirm</x-slot>
</livewire:modal>


Refs :

Ciblage direct d’un composant enfant :
blade
Copier

<button wire:click="$ref('modal').close()">Fermer</button>


Chargement Paresseux (lazy)

Chargement différé des composants lourds.
Placeholder personnalisable pendant le chargement.
Chargement au scroll si le composant est hors vue.
Exemple :
blade
Copier

<livewire:stats lazy placeholder="placeholders.stats" />


Streaming de Réponses

wire:stream :

Affiche du contenu en temps réel (ex: réponse d’une IA).
Utilisation de partial() pour envoyer des morceaux de réponse.
Exemple :
php
Copier

$this->stream(to: 'answer', content: $partialResponse);

blade
Copier

<div wire:stream="answer"></div>



Islands

Isolation d’une partie d’un template pour éviter le blocage du reste.
Syntaxe :
blade
Copier

@island
    <livewire:heavy-chart />
@endisland


Options :

lazy : chargement différé.
wire:poll : rafraîchissement indépendant.
wire:intersect : chargement à l’intersection (infinite scroll).

Blaze

Optimisation Blade :

Technique de "code folding" : pré-rendu des parties statiques à la compilation.
Résultat : 25 000 composants Blade rendus en 19 ms (vs 508 ms sans Blaze).


4. Outils de Développement

Wiretap :

DevTools intégrées (accessibles via Cmd+K).
Inspection des composants, états, requêtes réseau.
Time travel : replay des états précédents.
Mesure des temps d’exécution (requête, Laravel, Livewire, SQL).
Hot reloading : mise à jour instantanée du code.


5. Performances et Optimisations

Bundling des requêtes :

Regroupement des mises à jour de plusieurs composants en une seule requête réseau.

Polling intelligent :

Priorité aux actions utilisateur, annulation des requêtes de fond pendant une interaction.

Optimisation du rendu :

Nouveau système de diffing (Morph Dom).
Blaze pour les composants Blade.


6. Migration et Compatibilité

Outil d’upgrade :

Commande artisan livewire:upgrade pour migrer depuis les versions précédentes.
Détection et correction automatique des incompatibilités.

Documentation :

Réécriture complète, avec plus d’exemples et de contexte.
Intégration visuelle dans laravel.com/livewire.


7. Cas d’Usage et Exemples

Formulaires réactifs :
blade
Copier

<input wire:model.blur="title" type="text">
<button wire:click="save">Enregistrer</button>


Navigation SPA :
blade
Copier

<a href="/posts" wire:navigate>Posts</a>


Streaming :
php
Copier

$this->stream(to: 'answer', content: $partialResponse);


Composant single-file :
php
Copier

// Counter.wire.php
class Counter extends Component
{
    public $count = 0;
    public function increment() { $this->count++; }
}

<div>
    <button wire:click="increment">+</button>
    {{ $count }}
</div>


Island :
blade
Copier

@island
    <livewire:heavy-chart />
@endisland



8. Synthèse des Innovations


  
    
      Fonctionnalité
      Description
    
  
  
    
      Intégration Alpine.js
      Utilisation native d’Alpine.js, exposition de $wire.
    
    
      Composants
      Classique, Volt, Single-file, Multi-file, Form Objects.
    
    
      Diffing (Morph Dom)
      Algorithme maison pour les mises à jour du DOM.
    
    
      Navigation SPA
      wire:navigate pour une navigation instantanée.
    
    
      JS depuis PHP
      $this->js() pour exécuter du JavaScript côté serveur.
    
    
      Attributs PHP
      #[Rule], #[Locked], #[Url], et attributs personnalisés.
    
    
      Validation
      Intégrée via attributs, réactivité en temps réel.
    
    
      Nesting
      Réactivité parent/enfant, slots, refs.
    
    
      Lazy Loading
      Chargement différé avec placeholders.
    
    
      Streaming
      wire:stream pour afficher du contenu en temps réel.
    
    
      Islands
      Isolation des parties lourdes du template.
    
    
      Blaze
      Optimisation radicale des performances Blade.
    
    
      Wiretap
      DevTools intégrées pour le débogage et l’inspection.
    
    
      Migration
      Outil CLI et documentation complète.
    
  


<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to enhance the user's satisfaction building Laravel applications.

## Foundational Context
This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.5.1
- laravel/folio (FOLIO) - v1
- laravel/fortify (FORTIFY) - v1
- laravel/framework (LARAVEL) - v12
- laravel/horizon (HORIZON) - v5
- laravel/pennant (PENNANT) - v1
- laravel/prompts (PROMPTS) - v0
- laravel/reverb (REVERB) - v1
- laravel/scout (SCOUT) - v10
- laravel/socialite (SOCIALITE) - v5
- laravel/telescope (TELESCOPE) - v5
- livewire/flux (FLUXUI_FREE) - v2
- livewire/livewire (LIVEWIRE) - v4
- livewire/volt (VOLT) - v1
- laravel/mcp (MCP) - v0
- laravel/pint (PINT) - v1
- laravel/sail (SAIL) - v1
- pestphp/pest (PEST) - v4
- phpunit/phpunit (PHPUNIT) - v12
- tailwindcss (TAILWINDCSS) - v4
- laravel-echo (ECHO) - v2

## Conventions
- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts
- Do not create verification scripts or tinker when tests cover that functionality and prove it works. Unit and feature tests are more important.

## Application Structure & Architecture
- Stick to existing directory structure - don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling
- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `vendor/bin/sail npm run build`, `vendor/bin/sail npm run dev`, or `vendor/bin/sail composer run dev`. Ask them.

## Replies
- Be concise in your explanations - focus on what's important rather than explaining obvious details.

## Documentation Files
- You must only create documentation files if explicitly requested by the user.


=== boost rules ===

## Laravel Boost
- Laravel Boost is an MCP server that comes with powerful tools designed specifically for this application. Use them.

## Artisan
- Use the `list-artisan-commands` tool when you need to call an Artisan command to double check the available parameters.

## URLs
- Whenever you share a project URL with the user you should use the `get-absolute-url` tool to ensure you're using the correct scheme, domain / IP, and port.

## Tinker / Debugging
- You should use the `tinker` tool when you need to execute PHP to debug code or query Eloquent models directly.
- Use the `database-query` tool when you only need to read from the database.

## Reading Browser Logs With the `browser-logs` Tool
- You can read browser logs, errors, and exceptions using the `browser-logs` tool from Boost.
- Only recent browser logs will be useful - ignore old logs.

## Searching Documentation (Critically Important)
- Boost comes with a powerful `search-docs` tool you should use before any other approaches. This tool automatically passes a list of installed packages and their versions to the remote Boost API, so it returns only version-specific documentation specific for the user's circumstance. You should pass an array of packages to filter on if you know you need docs for particular packages.
- The 'search-docs' tool is perfect for all Laravel related packages, including Laravel, Inertia, Livewire, Filament, Tailwind, Pest, Nova, Nightwatch, etc.
- You must use this tool to search for Laravel-ecosystem documentation before falling back to other approaches.
- Search the documentation before making code changes to ensure we are taking the correct approach.
- Use multiple, broad, simple, topic based queries to start. For example: `['rate limiting', 'routing rate limiting', 'routing']`.
- Do not add package names to queries - package information is already shared. For example, use `test resource table`, not `filament 4 test resource table`.

### Available Search Syntax
- You can and should pass multiple queries at once. The most relevant results will be returned first.

1. Simple Word Searches with auto-stemming - query=authentication - finds 'authenticate' and 'auth'
2. Multiple Words (AND Logic) - query=rate limit - finds knowledge containing both "rate" AND "limit"
3. Quoted Phrases (Exact Position) - query="infinite scroll" - Words must be adjacent and in that order
4. Mixed Queries - query=middleware "rate limit" - "middleware" AND exact phrase "rate limit"
5. Multiple Queries - queries=["authentication", "middleware"] - ANY of these terms


=== php rules ===

## PHP

- Always use curly braces for control structures, even if it has one line.

### Constructors
- Use PHP 8 constructor property promotion in `__construct()`.
    - <code-snippet>public function __construct(public GitHub $github) { }</code-snippet>
- Do not allow empty `__construct()` methods with zero parameters.

### Type Declarations
- Always use explicit return type declarations for methods and functions.
- Use appropriate PHP type hints for method parameters.

<code-snippet name="Explicit Return Types and Method Params" lang="php">
protected function isAccessible(User $user, ?string $path = null): bool
{
    ...
}
</code-snippet>

## Comments
- Prefer PHPDoc blocks over comments. Never use comments within the code itself unless there is something _very_ complex going on.

## PHPDoc Blocks
- Add useful array shape type definitions for arrays when appropriate.

## Enums
- Typically, keys in an Enum should be TitleCase. For example: `FavoritePerson`, `BestLake`, `Monthly`.


=== sail rules ===

## Laravel Sail

- This project runs inside Laravel Sail's Docker containers. You MUST execute all commands through Sail.
- Start services using `vendor/bin/sail up -d` and stop them with `vendor/bin/sail stop`.
- Open the application in the browser by running `vendor/bin/sail open`.
- Always prefix PHP, Artisan, Composer, and Node commands** with `vendor/bin/sail`. Examples:
- Run Artisan Commands: `vendor/bin/sail artisan migrate`
- Install Composer packages: `vendor/bin/sail composer install`
- Execute node commands: `vendor/bin/sail npm run dev`
- Execute PHP scripts: `vendor/bin/sail php [script]`
- View all available Sail commands by running `vendor/bin/sail` without arguments.


=== tests rules ===

## Test Enforcement

- Every change must be programmatically tested. Write a new test or update an existing test, then run the affected tests to make sure they pass.
- Run the minimum number of tests needed to ensure code quality and speed. Use `vendor/bin/sail artisan test` with a specific filename or filter.


=== folio/core rules ===

## Laravel Folio

- Laravel Folio is a file based router. With Laravel Folio, a new route is created for every Blade file within the configured Folio directory. For example, pages are usually in in `resources/views/pages/` and the file structure determines routes:
    - `pages/index.blade.php` → `/`
    - `pages/profile/index.blade.php` → `/profile`
    - `pages/auth/login.blade.php` → `/auth/login`
- You may list available Folio routes using `vendor/bin/sail artisan folio:list`  or using Boost's `list-routes` tool.

### New Pages & Routes
- Always create new `folio` pages and routes using `vendor/bin/sail artisan folio:page [name]` following existing naming conventions.

<code-snippet name="Example folio:page Commands for Automatic Routing" lang="shell">
    // Creates: resources/views/pages/products.blade.php → /products
    vendor/bin/sail artisan folio:page "products"

    // Creates: resources/views/pages/products/[id].blade.php → /products/{id}
    vendor/bin/sail artisan folio:page "products/[id]"
</code-snippet>

- Add a 'name' to each new Folio page at the very top of the file so it has a named route available for other parts of the codebase to use.


<code-snippet name="Adding named route to Folio page" lang="php">
use function Laravel\Folio\name;

name('products.index');
</code-snippet>


### Support & Documentation
- Folio supports: middleware, serving pages from multiple paths, subdomain routing, named routes, nested routes, index routes, route parameters, and route model binding.
- If available, use Boost's `search-docs` tool to use Folio to its full potential and help the user effectively.


<code-snippet name="Folio Middleware Example" lang="php">
use function Laravel\Folio\{name, middleware};

name('admin.products');
middleware(['auth', 'verified', 'can:manage-products']);
?>
</code-snippet>


=== laravel/core rules ===

## Do Things the Laravel Way

- Use `vendor/bin/sail artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using the `list-artisan-commands` tool.
- If you're creating a generic PHP class, use `vendor/bin/sail artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Database
- Always use proper Eloquent relationship methods with return type hints. Prefer relationship methods over raw queries or manual joins.
- Use Eloquent models and relationships before suggesting raw database queries
- Avoid `DB::`; prefer `Model::query()`. Generate code that leverages Laravel's ORM capabilities rather than bypassing them.
- Generate code that prevents N+1 query problems by using eager loading.
- Use Laravel's query builder for very complex database operations.

### Model Creation
- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `list-artisan-commands` to check the available options to `vendor/bin/sail artisan make:model`.

### APIs & Eloquent Resources
- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

### Controllers & Validation
- Always create Form Request classes for validation rather than inline validation in controllers. Include both validation rules and custom error messages.
- Check sibling Form Requests to see if the application uses array or string based validation rules.

### Queues
- Use queued jobs for time-consuming operations with the `ShouldQueue` interface.

### Authentication & Authorization
- Use Laravel's built-in authentication and authorization features (gates, policies, Sanctum, etc.).

### URL Generation
- When generating links to other pages, prefer named routes and the `route()` function.

### Configuration
- Use environment variables only in configuration files - never use the `env()` function directly outside of config files. Always use `config('app.name')`, not `env('APP_NAME')`.

### Testing
- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `vendor/bin/sail artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

### Vite Error
- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `vendor/bin/sail npm run build` or ask the user to run `vendor/bin/sail npm run dev` or `vendor/bin/sail composer run dev`.


=== laravel/v12 rules ===

## Laravel 12

- Use the `search-docs` tool to get version specific documentation.
- Since Laravel 11, Laravel has a new streamlined file structure which this project uses.

### Laravel 12 Structure
- No middleware files in `app/Http/Middleware/`.
- `bootstrap/app.php` is the file to register middleware, exceptions, and routing files.
- `bootstrap/providers.php` contains application specific service providers.
- **No app\Console\Kernel.php** - use `bootstrap/app.php` or `routes/console.php` for console configuration.
- **Commands auto-register** - files in `app/Console/Commands/` are automatically available and do not require manual registration.

### Database
- When modifying a column, the migration must include all of the attributes that were previously defined on the column. Otherwise, they will be dropped and lost.
- Laravel 11 allows limiting eagerly loaded records natively, without external packages: `$query->latest()->limit(10);`.

### Models
- Casts can and likely should be set in a `casts()` method on a model rather than the `$casts` property. Follow existing conventions from other models.


=== pennant/core rules ===

## Laravel Pennant

- This application uses Laravel Pennant for feature flag management, providing a flexible system for controlling feature availability across different organizations and user types.
- Use the `search-docs` tool if available, in combination with existing codebase conventions, to assist the user effectively with feature flags.


=== fluxui-free/core rules ===

## Flux UI Free

- This project is using the free edition of Flux UI. It has full access to the free components and variants, but does not have access to the Pro components.
- Flux UI is a component library for Livewire. Flux is a robust, hand-crafted, UI component library for your Livewire applications. It's built using Tailwind CSS and provides a set of components that are easy to use and customize.
- You should use Flux UI components when available.
- Fallback to standard Blade components if Flux is unavailable.
- If available, use Laravel Boost's `search-docs` tool to get the exact documentation and code snippets available for this project.
- Flux UI components look like this:

<code-snippet name="Flux UI Component Usage Example" lang="blade">
    <flux:button variant="primary"/>
</code-snippet>


### Available Components
This is correct as of Boost installation, but there may be additional components within the codebase.

<available-flux-components>
avatar, badge, brand, breadcrumbs, button, callout, checkbox, dropdown, field, heading, icon, input, modal, navbar, otp-input, profile, radio, select, separator, skeleton, switch, text, textarea, tooltip
</available-flux-components>


=== livewire/core rules ===

## Livewire Core
- Use the `search-docs` tool to find exact version specific documentation for how to write Livewire & Livewire tests.
- Use the `vendor/bin/sail artisan make:livewire [Posts\CreatePost]` artisan command to create new components
- State should live on the server, with the UI reflecting it.
- All Livewire requests hit the Laravel backend, they're like regular HTTP requests. Always validate form data, and run authorization checks in Livewire actions.

## Livewire Best Practices
- Livewire components require a single root element.
- Use `wire:loading` and `wire:dirty` for delightful loading states.
- Add `wire:key` in loops:

    ```blade
    @foreach ($items as $item)
        <div wire:key="item-{{ $item->id }}">
            {{ $item->name }}
        </div>
    @endforeach
    ```

- Prefer lifecycle hooks like `mount()`, `updatedFoo()` for initialization and reactive side effects:

<code-snippet name="Lifecycle hook examples" lang="php">
    public function mount(User $user) { $this->user = $user; }
    public function updatedSearch() { $this->resetPage(); }
</code-snippet>


## Testing Livewire

<code-snippet name="Example Livewire component test" lang="php">
    Livewire::test(Counter::class)
        ->assertSet('count', 0)
        ->call('increment')
        ->assertSet('count', 1)
        ->assertSee(1)
        ->assertStatus(200);
</code-snippet>


    <code-snippet name="Testing a Livewire component exists within a page" lang="php">
        $this->get('/posts/create')
        ->assertSeeLivewire(CreatePost::class);
    </code-snippet>


=== volt/core rules ===

## Livewire Volt

- This project uses Livewire Volt for interactivity within its pages. New pages requiring interactivity must also use Livewire Volt. There is documentation available for it.
- Make new Volt components using `vendor/bin/sail artisan make:volt [name] [--test] [--pest]`
- Volt is a **class-based** and **functional** API for Livewire that supports single-file components, allowing a component's PHP logic and Blade templates to co-exist in the same file
- Livewire Volt allows PHP logic and Blade templates in one file. Components use the `@volt` directive.
- You must check existing Volt components to determine if they're functional or class based. If you can't detect that, ask the user which they prefer before writing a Volt component.

### Volt Functional Component Example

<code-snippet name="Volt Functional Component Example" lang="php">
@volt
<?php
use function Livewire\Volt\{state, computed};

state(['count' => 0]);

$increment = fn () => $this->count++;
$decrement = fn () => $this->count--;

$double = computed(fn () => $this->count * 2);
?>

<div>
    <h1>Count: {{ $count }}</h1>
    <h2>Double: {{ $this->double }}</h2>
    <button wire:click="increment">+</button>
    <button wire:click="decrement">-</button>
</div>
@endvolt
</code-snippet>


### Volt Class Based Component Example
To get started, define an anonymous class that extends Livewire\Volt\Component. Within the class, you may utilize all of the features of Livewire using traditional Livewire syntax:


<code-snippet name="Volt Class-based Volt Component Example" lang="php">
use Livewire\Volt\Component;

new class extends Component {
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }
} ?>

<div>
    <h1>{{ $count }}</h1>
    <button wire:click="increment">+</button>
</div>
</code-snippet>


### Testing Volt & Volt Components
- Use the existing directory for tests if it already exists. Otherwise, fallback to `tests/Feature/Volt`.

<code-snippet name="Livewire Test Example" lang="php">
use Livewire\Volt\Volt;

test('counter increments', function () {
    Volt::test('counter')
        ->assertSee('Count: 0')
        ->call('increment')
        ->assertSee('Count: 1');
});
</code-snippet>


<code-snippet name="Volt Component Test Using Pest" lang="php">
declare(strict_types=1);

use App\Models\{User, Product};
use Livewire\Volt\Volt;

test('product form creates product', function () {
    $user = User::factory()->create();

    Volt::test('pages.products.create')
        ->actingAs($user)
        ->set('form.name', 'Test Product')
        ->set('form.description', 'Test Description')
        ->set('form.price', 99.99)
        ->call('create')
        ->assertHasNoErrors();

    expect(Product::where('name', 'Test Product')->exists())->toBeTrue();
});
</code-snippet>


### Common Patterns


<code-snippet name="CRUD With Volt" lang="php">
<?php

use App\Models\Product;
use function Livewire\Volt\{state, computed};

state(['editing' => null, 'search' => '']);

$products = computed(fn() => Product::when($this->search,
    fn($q) => $q->where('name', 'like', "%{$this->search}%")
)->get());

$edit = fn(Product $product) => $this->editing = $product->id;
$delete = fn(Product $product) => $product->delete();

?>

<!-- HTML / UI Here -->
</code-snippet>

<code-snippet name="Real-Time Search With Volt" lang="php">
    <flux:input
        wire:model.live.debounce.300ms="search"
        placeholder="Search..."
    />
</code-snippet>

<code-snippet name="Loading States With Volt" lang="php">
    <flux:button wire:click="save" wire:loading.attr="disabled">
        <span wire:loading.remove>Save</span>
        <span wire:loading>Saving...</span>
    </flux:button>
</code-snippet>


=== mcp/core rules ===

## Laravel MCP

- MCP (Model Context Protocol) is very new. You must use the `search-docs` tool to get documentation for how to write and test Laravel MCP servers, tools, resources, and prompts effectively.
- MCP servers need to be registered with a route or handle in `routes/ai.php`. Typically, they will be registered using `Mcp::web()` to register a HTTP streaming MCP server.
- Servers are very testable - use the `search-docs` tool to find testing instructions.
- Do not run `mcp:start`. This command hangs waiting for JSON RPC MCP requests.
- Some MCP clients use Node, which has its own certificate store. If a user tries to connect to their web MCP server locally using https://, it could fail due to this reason. They will need to switch to http:// during local development.


=== pint/core rules ===

## Laravel Pint Code Formatter

- You must run `vendor/bin/sail bin pint --dirty` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/sail bin pint --test`, simply run `vendor/bin/sail bin pint` to fix any formatting issues.


=== pest/core rules ===

## Pest
### Testing
- If you need to verify a feature is working, write or update a Unit / Feature test.

### Pest Tests
- All tests must be written using Pest. Use `vendor/bin/sail artisan make:test --pest {name}`.
- You must not remove any tests or test files from the tests directory without approval. These are not temporary or helper files - these are core to the application.
- Tests should test all of the happy paths, failure paths, and weird paths.
- Tests live in the `tests/Feature` and `tests/Unit` directories.
- Pest tests look and behave like this:
<code-snippet name="Basic Pest Test Example" lang="php">
it('is true', function () {
    expect(true)->toBeTrue();
});
</code-snippet>

### Running Tests
- Run the minimal number of tests using an appropriate filter before finalizing code edits.
- To run all tests: `vendor/bin/sail artisan test`.
- To run all tests in a file: `vendor/bin/sail artisan test tests/Feature/ExampleTest.php`.
- To filter on a particular test name: `vendor/bin/sail artisan test --filter=testName` (recommended after making a change to a related file).
- When the tests relating to your changes are passing, ask the user if they would like to run the entire test suite to ensure everything is still passing.

### Pest Assertions
- When asserting status codes on a response, use the specific method like `assertForbidden` and `assertNotFound` instead of using `assertStatus(403)` or similar, e.g.:
<code-snippet name="Pest Example Asserting postJson Response" lang="php">
it('returns all', function () {
    $response = $this->postJson('/api/docs', []);

    $response->assertSuccessful();
});
</code-snippet>

### Mocking
- Mocking can be very helpful when appropriate.
- When mocking, you can use the `Pest\Laravel\mock` Pest function, but always import it via `use function Pest\Laravel\mock;` before using it. Alternatively, you can use `$this->mock()` if existing tests do.
- You can also create partial mocks using the same import or self method.

### Datasets
- Use datasets in Pest to simplify tests which have a lot of duplicated data. This is often the case when testing validation rules, so consider going with this solution when writing tests for validation rules.

<code-snippet name="Pest Dataset Example" lang="php">
it('has emails', function (string $email) {
    expect($email)->not->toBeEmpty();
})->with([
    'james' => 'james@laravel.com',
    'taylor' => 'taylor@laravel.com',
]);
</code-snippet>


=== pest/v4 rules ===

## Pest 4

- Pest v4 is a huge upgrade to Pest and offers: browser testing, smoke testing, visual regression testing, test sharding, and faster type coverage.
- Browser testing is incredibly powerful and useful for this project.
- Browser tests should live in `tests/Browser/`.
- Use the `search-docs` tool for detailed guidance on utilizing these features.

### Browser Testing
- You can use Laravel features like `Event::fake()`, `assertAuthenticated()`, and model factories within Pest v4 browser tests, as well as `RefreshDatabase` (when needed) to ensure a clean state for each test.
- Interact with the page (click, type, scroll, select, submit, drag-and-drop, touch gestures, etc.) when appropriate to complete the test.
- If requested, test on multiple browsers (Chrome, Firefox, Safari).
- If requested, test on different devices and viewports (like iPhone 14 Pro, tablets, or custom breakpoints).
- Switch color schemes (light/dark mode) when appropriate.
- Take screenshots or pause tests for debugging when appropriate.

### Example Tests

<code-snippet name="Pest Browser Test Example" lang="php">
it('may reset the password', function () {
    Notification::fake();

    $this->actingAs(User::factory()->create());

    $page = visit('/sign-in'); // Visit on a real browser...

    $page->assertSee('Sign In')
        ->assertNoJavascriptErrors() // or ->assertNoConsoleLogs()
        ->click('Forgot Password?')
        ->fill('email', 'nuno@laravel.com')
        ->click('Send Reset Link')
        ->assertSee('We have emailed your password reset link!')

    Notification::assertSent(ResetPassword::class);
});
</code-snippet>

<code-snippet name="Pest Smoke Testing Example" lang="php">
$pages = visit(['/', '/about', '/contact']);

$pages->assertNoJavascriptErrors()->assertNoConsoleLogs();
</code-snippet>


=== tailwindcss/core rules ===

## Tailwind Core

- Use Tailwind CSS classes to style HTML, check and use existing tailwind conventions within the project before writing your own.
- Offer to extract repeated patterns into components that match the project's conventions (i.e. Blade, JSX, Vue, etc..)
- Think through class placement, order, priority, and defaults - remove redundant classes, add classes to parent or child carefully to limit repetition, group elements logically
- You can use the `search-docs` tool to get exact examples from the official documentation when needed.

### Spacing
- When listing items, use gap utilities for spacing, don't use margins.

    <code-snippet name="Valid Flex Gap Spacing Example" lang="html">
        <div class="flex gap-8">
            <div>Superior</div>
            <div>Michigan</div>
            <div>Erie</div>
        </div>
    </code-snippet>


### Dark Mode
- If existing pages and components support dark mode, new pages and components must support dark mode in a similar way, typically using `dark:`.


=== tailwindcss/v4 rules ===

## Tailwind 4

- Always use Tailwind CSS v4 - do not use the deprecated utilities.
- `corePlugins` is not supported in Tailwind v4.
- In Tailwind v4, configuration is CSS-first using the `@theme` directive — no separate `tailwind.config.js` file is needed.
<code-snippet name="Extending Theme in CSS" lang="css">
@theme {
  --color-brand: oklch(0.72 0.11 178);
}
</code-snippet>

- In Tailwind v4, you import Tailwind using a regular CSS `@import` statement, not using the `@tailwind` directives used in v3:

<code-snippet name="Tailwind v4 Import Tailwind Diff" lang="diff">
   - @tailwind base;
   - @tailwind components;
   - @tailwind utilities;
   + @import "tailwindcss";
</code-snippet>


### Replaced Utilities
- Tailwind v4 removed deprecated utilities. Do not use the deprecated option - use the replacement.
- Opacity values are still numeric.

| Deprecated |	Replacement |
|------------+--------------|
| bg-opacity-* | bg-black/* |
| text-opacity-* | text-black/* |
| border-opacity-* | border-black/* |
| divide-opacity-* | divide-black/* |
| ring-opacity-* | ring-black/* |
| placeholder-opacity-* | placeholder-black/* |
| flex-shrink-* | shrink-* |
| flex-grow-* | grow-* |
| overflow-ellipsis | text-ellipsis |
| decoration-slice | box-decoration-slice |
| decoration-clone | box-decoration-clone |


=== laravel/fortify rules ===

## Laravel Fortify

Fortify is a headless authentication backend that provides authentication routes and controllers for Laravel applications.

**Before implementing any authentication features, use the `search-docs` tool to get the latest docs for that specific feature.**

### Configuration & Setup
- Check `config/fortify.php` to see what's enabled. Use `search-docs` for detailed information on specific features.
- Enable features by adding them to the `'features' => []` array: `Features::registration()`, `Features::resetPasswords()`, etc.
- To see the all Fortify registered routes, use the `list-routes` tool with the `only_vendor: true` and `action: "Fortify"` parameters.
- Fortify includes view routes by default (login, register). Set `'views' => false` in the configuration file to disable them if you're handling views yourself.

### Customization
- Views can be customized in `FortifyServiceProvider`'s `boot()` method using `Fortify::loginView()`, `Fortify::registerView()`, etc.
- Customize authentication logic with `Fortify::authenticateUsing()` for custom user retrieval / validation.
- Actions in `app/Actions/Fortify/` handle business logic (user creation, password reset, etc.). They're fully customizable, so you can modify them to change feature behavior.

## Available Features
- `Features::registration()` for user registration.
- `Features::emailVerification()` to verify new user emails.
- `Features::twoFactorAuthentication()` for 2FA with QR codes and recovery codes.
  - Add options: `['confirmPassword' => true, 'confirm' => true]` to require password confirmation and OTP confirmation before enabling 2FA.
- `Features::updateProfileInformation()` to let users update their profile.
- `Features::updatePasswords()` to let users change their passwords.
- `Features::resetPasswords()` for password reset via email.
</laravel-boost-guidelines>

Components
Are you a visual learner?
Master Livewire with our in-depth screencasts
Watch now

Livewire components are essentially PHP classes with properties and methods that can be called directly from a Blade template. This powerful combination allows you to create full-stack interactive interfaces with a fraction of the effort and complexity of modern JavaScript alternatives.

This guide covers everything you need to know about creating, rendering, and organizing Livewire components. You'll learn about the different component formats available (single-file, multi-file, and class-based), how to pass data between components, and how to use components as full pages.
#
Creating components

You can create a component using the make:livewire Artisan command:

php artisan make:livewire post.create

This creates a single-file component at:

resources/views/components/post/⚡create.blade.php

<?php
 
use Livewire\Component;
 
new class extends Component {
    public $title = '';
 
    public function save()
    {
        // Save logic here...
    }
};
?>
 
<div>
    <input wire:model="title" type="text">
    <button wire:click="save">Save Post</button>
</div>

Why the ⚡ emoji?

You might be wondering about the lightning bolt in the filename. This small touch serves a practical purpose: it makes Livewire components instantly recognizable in your editor's file tree and search results. Since it's a Unicode character, it works seamlessly across all platforms — Windows, macOS, Linux, Git, and your production servers.

The emoji is completely optional and if you find it outside your comfort zone you can disable it entirely in your config/livewire.php file:

'make_command' => [
    'emoji' => false,
],

#
Creating page components

When creating components that will be used as full pages, use the pages:: namespace to organize them in a dedicated directory:

php artisan make:livewire pages::post.create

This creates the component at resources/views/pages/post/⚡create.blade.php. This organization makes it clear which components are pages versus reusable UI components.

Learn more about using components as pages in the Page components section below. You can also register your own custom namespaces—see the Component namespaces documentation.
#
Multi-file components

As your component or project grows, you might find the single-file approach limiting. Livewire offers a multi-file alternative that splits your component into separate files for better organization and IDE support.

To create a multi-file component, pass the --mfc flag:

php artisan make:livewire post.create --mfc

This creates a directory with all related files together:

resources/views/components/post/⚡create/
├── create.php        # PHP class
├── create.blade.php  # Blade template
├── create.js         # JavaScript (optional, with --js flag)
└── create.test.php   # Pest test (optional, with --test flag)

#
Converting between formats

Livewire provides the livewire:convert command to seamlessly convert components between single-file and multi-file formats.

Auto-detect and convert:

php artisan livewire:convert post.create
# Single-file → Multi-file (or vice versa)

Explicitly convert to multi-file:

php artisan livewire:convert post.create --mfc

This will parse your single-file component, create a directory structure, split the files, and delete the original.

Explicitly convert to single-file:

php artisan livewire:convert post.create --sfc

This combines all files back into a single file and deletes the directory.
Test files are deleted when converting to single-file

If your multi-file component has a test file, you'll be prompted to confirm before conversion since test files cannot be preserved in the single-file format.
#
When to use each format

Single-file components (default):

    Best for most components
    Keeps related code together
    Easy to understand at a glance
    Perfect for small to medium components

Multi-file components:

    Better for large, complex components
    Improved IDE support and navigation
    Clearer separation when components have significant JavaScript

Class-based components:

    Familiar to developers from Livewire v2/v3
    Traditional Laravel separation of concerns
    Better for teams with established conventions
    See Class-based components below

#
Rendering components

You can include a Livewire component within any Blade template using the <livewire:component-name /> syntax:

<livewire:component-name />

If the component is located in a sub-directory, you can indicate this using the dot (.) character:

resources/views/components/post/⚡create.blade.php

<livewire:post.create />

For namespaced components—like pages::—use the namespace prefix:

<livewire:pages::post.create />

#
Passing props

To pass data into a Livewire component, you can use prop attributes on the component tag:

<livewire:post.create title="Initial Title" />

For dynamic values or variables, prefix the attribute with a colon:

<livewire:post.create :title="$initialTitle" />

Data passed into components is received through the mount() method:

<?php
 
use Livewire\Component;
 
new class extends Component {
    public $title;
 
    public function mount($title = null)
    {
        $this->title = $title;
    }
 
    // ...
};

You can think of the mount() method as a class constructor. It runs when the component initializes, but not on subsequent requests within a page's session. You can learn more about mount() and other helpful lifecycle hooks within the lifecycle documentation.

To reduce boilerplate code, you can omit the mount() method and Livewire will automatically set any properties with names matching the passed values:

<?php
 
use Livewire\Component;
 
new class extends Component {
    public $title; // Automatically set from prop
 
    // ...
};

These properties are not reactive by default

The $title property will not update automatically if the outer :title="$initialValue" changes after the initial page load. This is a common point of confusion when using Livewire, especially for developers who have used JavaScript frameworks like Vue or React and assume these parameters behave like "reactive props" in those frameworks. But, don't worry, Livewire allows you to opt-in to making your props reactive.
#
Passing route parameters as props

When using components as pages, you can pass route parameters directly to your component. The route parameters are automatically passed to the mount() method:

Route::livewire('/posts/{id}', 'pages::post.show');

<?php // resources/views/pages/post/⚡show.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $postId;
 
    public function mount($id)
    {
        $this->postId = $id;
    }
};

Livewire also supports Laravel's route model binding:

Route::livewire('/posts/{post}', 'pages::post.show');

<?php // resources/views/pages/post/⚡show.blade.php
 
use App\Models\Post;
use Livewire\Component;
 
new class extends Component {
    public Post $post; // Automatically bound from route
 
    // No mount() needed - Livewire handles it automatically
};

#
Page components

Components can be routed to directly as full pages using Route::livewire(). This is one of Livewire's most powerful features, allowing you to build entire pages without traditional controllers.

Route::livewire('/posts/create', 'pages::post.create');

When a user visits /posts/create, Livewire will render the pages::post.create component inside your application's layout file.

Page components work just like regular components, but they're rendered as full pages with access to:

    Custom layouts
    Page titles
    Route parameters and model binding
    Named slots for layouts

For complete information about page components, including layouts, titles, and advanced routing, see the Pages documentation.
#
Accessing data in views

Livewire provides several ways to pass data to your component's Blade view. Each approach has different performance and security characteristics.
#
Component properties

The simplest approach is using public properties, which are automatically available in your Blade template:

<?php
 
use Livewire\Component;
 
new class extends Component {
    public $title = 'My Post';
};

<div>
    <h1>{{ $title }}</h1>
</div>

Protected properties must be accessed with $this->:

public $title = 'My Post';           // Available as {{ $title }}
protected $apiKey = 'secret-key';    // Available as {{ $this->apiKey }}

Protected properties are not sent to the client

Unlike public properties, protected properties are never sent to the frontend and cannot be manipulated by users. This makes them safe for sensitive data. However, they are not persisted between requests, which limits their usefulness in most Livewire scenarios. They're best used for static values defined in the property declaration that you don't want exposed client-side.

For complete information about properties, including persistence behavior and advanced features, see the properties documentation.
#
Computed properties

Computed properties are methods that act like memoized properties. They're perfect for expensive operations like database queries:

use Livewire\Attributes\Computed;
 
#[Computed]
public function posts()
{
    return Post::with('author')->latest()->get();
}

<div>
    @foreach ($this->posts as $post)
        <article wire:key="{{ $post->id }}">{{ $post->title }}</article>
    @endforeach
</div>

Notice the $this-> prefix - this tells Livewire to call the method and cache the result for the current request only (not between requests). For more details, see the computed properties section in the properties documentation.
#
Passing data from render()

Similar to a controller, you can pass data directly to the view using the render() method:

public function render()
{
    return $this->view([
        'author' => Auth::user(),
        'currentTime' => now(),
    ]);
}

Keep in mind that render() runs on every component update, so avoid expensive operations here unless you need fresh data on every update.
#
Organizing components

While Livewire automatically discovers components in the default resources/views/components/ directory, you can customize where Livewire looks for components and organize them using namespaces.
#
Component namespaces

Component namespaces allow you to organize components into dedicated directories with a clean reference syntax.

By default, Livewire provides two namespaces:

    pages:: — Points to resources/views/pages/
    layouts:: — Points to resources/views/layouts/

You can define additional namespaces in your config/livewire.php file:

'component_namespaces' => [
    'layouts' => resource_path('views/layouts'),
    'pages' => resource_path('views/pages'),
    'admin' => resource_path('views/admin'),    // Custom namespace
    'widgets' => resource_path('views/widgets'), // Another custom namespace
],

Then use them when creating, rendering, and routing:

php artisan make:livewire admin::users-table

<livewire:admin::users-table />

Route::livewire('/admin/users', 'admin::users-table');

#
Additional component locations

If you want Livewire to discover components in additional directories beyond the defaults, you can configure them in your config/livewire.php file:

'component_paths' => [
    resource_path('views/components'),
    resource_path('views/admin/components'),
    resource_path('views/widgets'),
],

Now Livewire will automatically discover components in all these directories.
#
Programmatic registration

For more dynamic scenarios (like package development or runtime configuration), you can register components, locations, and namespaces programmatically in a service provider:

Register an individual component:

use Livewire\Livewire;
 
// In a service provider's boot() method (e.g., App\Providers\AppServiceProvider)
Livewire::addComponent(
    name: 'custom-button',
    viewPath: resource_path('views/ui/button.blade.php')
);

Register a component directory:

Livewire::addLocation(
    viewPath: resource_path('views/admin/components')
);

Register a namespace:

Livewire::addNamespace(
    namespace: 'ui',
    viewPath: resource_path('views/ui')
);

This approach is useful when you need to register components conditionally or when building Laravel packages that provide Livewire components.
#
Registering class-based components

For class-based components, use the same methods but with the class parameter instead of path:

use Livewire\Livewire;
 
// In a service provider's boot() method (e.g., App\Providers\AppServiceProvider)
 
// Register an individual class-based component
Livewire::addComponent(
    name: 'todos',
    \App\Livewire\Todos::class
);
 
// Register a location for class-based components
Livewire::addLocation(
    classNamespace: 'App\\Admin\\Livewire'
);
 
// Create a namespace for class-based components
Livewire::addNamespace(
    namespace: 'admin',
    classNamespace: 'App\\Admin\\Livewire',
    classPath: app_path('Admin/Livewire'),
    classViewPath: resource_path('views/admin/livewire')
);

#
Class-based components

For teams migrating from Livewire v3 or those who prefer a more traditional Laravel structure, Livewire fully supports class-based components. This approach separates the PHP class and Blade view into different files in their conventional locations.
#
Creating class-based components

php artisan make:livewire CreatePost --class

This creates two separate files:

app/Livewire/CreatePost.php

<?php
 
namespace App\Livewire;
 
use Livewire\Component;
 
class CreatePost extends Component
{
    public function render()
    {
        return view('livewire.create-post');
    }
}

resources/views/livewire/create-post.blade.php

<div>
    {{-- ... --}}
</div>

#
When to use class-based components

Use class-based components when:

    Migrating from Livewire v2/v3
    Your team prefers a more traditional file structure
    You have established conventions around class-based architecture

Use single-file or multi-file components when:

    Starting a new Livewire v4 project
    You want better component colocation
    You want to use the latest Livewire conventions

#
Configuring default component type

If you want class-based components by default, configure it in config/livewire.php:

'make_command' => [
    'type' => 'class',
],

#
Customizing component stubs

You can customize the files (or stubs) Livewire uses to generate new components by running:

php artisan livewire:stubs

This creates stub files in your application that you can modify:

Single-file component stubs:

    stubs/livewire-sfc.stub — Single-file components

Multi-file component stubs:

    stubs/livewire-mfc-class.stub — PHP class for multi-file components
    stubs/livewire-mfc-view.stub — Blade view for multi-file components
    stubs/livewire-mfc-js.stub — JavaScript for multi-file components
    stubs/livewire-mfc-test.stub — Pest test for multi-file components

Class-based component stubs:

    stubs/livewire.stub — PHP class for class-based components
    stubs/livewire.view.stub — Blade view for class-based components

Additional stubs:

    stubs/livewire.attribute.stub — Attribute classes
    stubs/livewire.form.stub — Form classes

Once published, Livewire will automatically use your custom stubs when generating new components.
#
Troubleshooting
#
Component not found

Symptom: Error message like "Component [post.create] not found" or "Unable to find component"

Solutions:

    Verify the component file exists at the expected path
    Check that the component name in your view matches the file structure (dots for subdirectories)
    For namespaced components, ensure the namespace is defined in config/livewire.php or manually registered in a service provider
    Try clearing your view cache: php artisan view:clear

#
Component shows blank or doesn't render

Common causes:

    Missing root element in your Blade template (Livewire requires exactly one root element)
    Syntax errors in the PHP section of your component
    Check your Laravel logs for detailed error messages

#
Class name conflicts

Symptom: Errors about duplicate class names when using single-file components

Solution: This can happen if you have multiple single-file components with the same name in different directories. Either:

    Rename one of the components to be unique
    Namespace one of the directories for more clear separation

#
See also

    Properties — Manage component state and data
    Actions — Handle user interactions with methods
    Pages — Use components as full pages with routing
    Nesting — Compose components together and pass data between them
    Lifecycle Hooks — Execute code at specific points in a component's lifecycle

Pages
Are you a visual learner?
Master Livewire with our in-depth screencasts
Watch now
Pages
Livewire components can be used as entire pages by assigning them directly to routes. This allows you to build complete application pages using Livewire components, with additional capabilities like custom layouts, page titles, and route parameters.

#Routing to components
To route to a component, use the Route::livewire() method in your routes/web.php file:

Route::livewire('/posts/create', 'pages::post.create');
When you visit the specified URL, the component will be rendered as a complete page using your application's layout.

#Layouts
Components rendered via routes will use your application's layout file. By default, Livewire looks for a layout called layouts::app located at resources/views/layouts/app.blade.php.

You may create this file if it doesn't already exist by running the following command:

php artisan livewire:layout
This command will generate a file called resources/views/layouts/app.blade.php.

Ensure you have created a Blade file at this location and included a {{ $slot }} placeholder:

<!-- resources/views/layouts/app.blade.php -->
 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>{{ $title ?? config('app.name') }}</title>
 
        @vite(['resources/css/app.css', 'resources/js/app.js'])
 
        @livewireStyles
    </head>
    <body>
        {{ $slot }}
 
        @livewireScripts
    </body>
</html>
You may customize the default layout by updating the component_layout configuration option in your config/livewire.php file:

'component_layout' => 'layouts::dashboard',
#Component-specific layouts
To use a different layout for a specific component, you may place the #[Layout] attribute above your component class:

<?php
 
use Livewire\Attributes\Layout;
use Livewire\Component;
 
new #[Layout('layouts::dashboard')] class extends Component { 
    // ...
};
Alternatively, you may use the ->layout() method within your component's render() method:

<?php
 
use Livewire\Component;
 
new class extends Component {
    // ...
 
    public function render()
    {
        return $this->view()
            ->layout('layouts::dashboard'); 
    }
};
#Setting the page title
Assigning unique page titles to each page in your application is helpful for both users and search engines.

To set a custom page title for a page component, first, make sure your layout file includes a dynamic title:

<head>
    <title>{{ $title ?? config('app.name') }}</title>
</head>
Next, above your Livewire component's class, add the #[Title] attribute and pass it your page title:

<?php
 
use Livewire\Attributes\Title;
use Livewire\Component;
 
new #[Title('Create post')] class extends Component { 
    // ...
};
This will set the page title for the component. In this example, the page title will be "Create Post" when the component is rendered.

If you need to pass a dynamic title, such as a title that uses a component property, you can use the ->title() fluent method in the component's render() method:

public function render()
{
    return $this->view()
         ->title('Create Post'); 
}
#Setting additional layout file slots
If your layout file has any named slots in addition to $slot, you can set their content in your Blade view by defining <x-slot> outside your root element. For example, if you want to be able to set the page language for each component individually, you can add a dynamic $lang slot into the opening HTML tag in your layout file:

<!-- resources/views/layouts/app.blade.php -->
 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $lang ?? app()->getLocale()) }}"> 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <title>{{ $title ?? config('app.name') }}</title>
 
        @vite(['resources/css/app.css', 'resources/js/app.js'])
 
        @livewireStyles
    </head>
    <body>
        {{ $slot }}
 
        @livewireScripts
    </body>
</html>
Then, in your component view, define an <x-slot> element outside the root element:

<x-slot:lang>fr</x-slot> // This component is in French 
 
<div>
    // French content goes here...
</div>
#Accessing route parameters
When working with page components, you may need to access route parameters within your Livewire component.

To demonstrate, first, define a route with a parameter in your routes/web.php file:

Route::livewire('/posts/{id}', 'pages::show-post');
Here, we've defined a route with an id parameter which represents a post's ID.

Next, update your Livewire component to accept the route parameter in the mount() method:

<?php
 
use App\Models\Post;
use Livewire\Component;
 
new class extends Component {
    public Post $post;
 
    public function mount($id) 
    {
        $this->post = Post::findOrFail($id);
    }
};
In this example, because the parameter name $id matches the route parameter {id}, if the /posts/1 URL is visited, Livewire will pass the value of "1" as $id.

#Using route model binding
Laravel's route model binding allows you to automatically resolve Eloquent models from route parameters.

After defining a route with a model parameter in your routes/web.php file:

Route::livewire('/posts/{post}', 'pages::show-post');
You can now accept the route model parameter through the mount() method of your component:

<?php
 
use App\Models\Post;
use Livewire\Component;
 
new class extends Component {
    public Post $post;
 
    public function mount(Post $post) 
    {
        $this->post = $post;
    }
};
Livewire knows to use "route model binding" because the Post type-hint is prepended to the $post parameter in mount().

Like before, you can reduce boilerplate by omitting the mount() method:

<?php
 
use Livewire\Component;
use App\Models\Post;
 
new class extends Component {
    public Post $post; 
};
The $post property will automatically be assigned to the model bound via the route's {post} parameter.

#See also
Components — Learn about creating and organizing components
Navigate — Build SPA-like navigation between pages
Redirecting — Redirect users after form submissions or actions
Layout Attribute — Specify layouts for full-page components
Title Attribute — Set page titles dynamically

Creating components
You can create a component using the make:livewire Artisan command:

php artisan make:livewire post.create
This creates a single-file component at:

resources/views/components/post/⚡create.blade.php

<?php
 
use Livewire\Component;
 
new class extends Component {
    public $title = '';
 
    public function save()
    {
        // Save logic here...
    }
};
?>
 
<div>
    <input wire:model="title" type="text">
    <button wire:click="save">Save Post</button>
</div>
Why the ⚡ emoji?
You might be wondering about the lightning bolt in the filename. This small touch serves a practical purpose: it makes Livewire components instantly recognizable in your editor's file tree and search results. Since it's a Unicode character, it works seamlessly across all platforms — Windows, macOS, Linux, Git, and your production servers.

The emoji is completely optional and if you find it outside your comfort zone you can disable it entirely in your config/livewire.php file:

'make_command' => [
    'emoji' => false,
],
#Creating page components
When creating components that will be used as full pages, use the pages:: namespace to organize them in a dedicated directory:

php artisan make:livewire pages::post.create
This creates the component at resources/views/pages/post/⚡create.blade.php. This organization makes it clear which components are pages versus reusable UI components.

Learn more about using components as pages in the Page components section below. You can also register your own custom namespaces—see the Component namespaces documentation.

#Multi-file components
As your component or project grows, you might find the single-file approach limiting. Livewire offers a multi-file alternative that splits your component into separate files for better organization and IDE support.

To create a multi-file component, pass the --mfc flag:

php artisan make:livewire post.create --mfc
This creates a directory with all related files together:

resources/views/components/post/⚡create/
├── create.php        # PHP class
├── create.blade.php  # Blade template
├── create.js         # JavaScript (optional, with --js flag)
└── create.test.php   # Pest test (optional, with --test flag)
#Converting between formats
Livewire provides the livewire:convert command to seamlessly convert components between single-file and multi-file formats.

Auto-detect and convert:

php artisan livewire:convert post.create
# Single-file → Multi-file (or vice versa)
Explicitly convert to multi-file:

php artisan livewire:convert post.create --mfc
This will parse your single-file component, create a directory structure, split the files, and delete the original.

Explicitly convert to single-file:

php artisan livewire:convert post.create --sfc
This combines all files back into a single file and deletes the directory.

Test files are deleted when converting to single-file
If your multi-file component has a test file, you'll be prompted to confirm before conversion since test files cannot be preserved in the single-file format.

#When to use each format
Single-file components (default):

Best for most components
Keeps related code together
Easy to understand at a glance
Perfect for small to medium components
Multi-file components:

Better for large, complex components
Improved IDE support and navigation
Clearer separation when components have significant JavaScript
Class-based components:

Familiar to developers from Livewire v2/v3
Traditional Laravel separation of concerns
Better for teams with established conventions
See Class-based components below
#Rendering components
You can include a Livewire component within any Blade template using the <livewire:component-name /> syntax:

<livewire:component-name />
If the component is located in a sub-directory, you can indicate this using the dot (.) character:

resources/views/components/post/⚡create.blade.php

<livewire:post.create />
For namespaced components—like pages::—use the namespace prefix:

<livewire:pages::post.create />
#Passing props
To pass data into a Livewire component, you can use prop attributes on the component tag:

<livewire:post.create title="Initial Title" />
For dynamic values or variables, prefix the attribute with a colon:

<livewire:post.create :title="$initialTitle" />
Data passed into components is received through the mount() method:

<?php
 
use Livewire\Component;
 
new class extends Component {
    public $title;
 
    public function mount($title = null)
    {
        $this->title = $title;
    }
 
    // ...
};
You can think of the mount() method as a class constructor. It runs when the component initializes, but not on subsequent requests within a page's session. You can learn more about mount() and other helpful lifecycle hooks within the lifecycle documentation.

To reduce boilerplate code, you can omit the mount() method and Livewire will automatically set any properties with names matching the passed values:

<?php
 
use Livewire\Component;
 
new class extends Component {
    public $title; // Automatically set from prop
 
    // ...
};
These properties are not reactive by default
The $title property will not update automatically if the outer :title="$initialValue" changes after the initial page load. This is a common point of confusion when using Livewire, especially for developers who have used JavaScript frameworks like Vue or React and assume these parameters behave like "reactive props" in those frameworks. But, don't worry, Livewire allows you to opt-in to making your props reactive.

#Passing route parameters as props
When using components as pages, you can pass route parameters directly to your component. The route parameters are automatically passed to the mount() method:

Route::livewire('/posts/{id}', 'pages::post.show');
<?php // resources/views/pages/post/⚡show.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $postId;
 
    public function mount($id)
    {
        $this->postId = $id;
    }
};
Livewire also supports Laravel's route model binding:

Route::livewire('/posts/{post}', 'pages::post.show');
<?php // resources/views/pages/post/⚡show.blade.php
 
use App\Models\Post;
use Livewire\Component;
 
new class extends Component {
    public Post $post; // Automatically bound from route
 
    // No mount() needed - Livewire handles it automatically
};
#Page components
Components can be routed to directly as full pages using Route::livewire(). This is one of Livewire's most powerful features, allowing you to build entire pages without traditional controllers.

Route::livewire('/posts/create', 'pages::post.create');
When a user visits /posts/create, Livewire will render the pages::post.create component inside your application's layout file.

Page components work just like regular components, but they're rendered as full pages with access to:

Custom layouts
Page titles
Route parameters and model binding
Named slots for layouts
For complete information about page components, including layouts, titles, and advanced routing, see the Pages documentation.

#Accessing data in views
Livewire provides several ways to pass data to your component's Blade view. Each approach has different performance and security characteristics.

#Component properties
The simplest approach is using public properties, which are automatically available in your Blade template:

<?php
 
use Livewire\Component;
 
new class extends Component {
    public $title = 'My Post';
};
<div>
    <h1>{{ $title }}</h1>
</div>
Protected properties must be accessed with $this->:

public $title = 'My Post';           // Available as {{ $title }}
protected $apiKey = 'secret-key';    // Available as {{ $this->apiKey }}
Protected properties are not sent to the client
Unlike public properties, protected properties are never sent to the frontend and cannot be manipulated by users. This makes them safe for sensitive data. However, they are not persisted between requests, which limits their usefulness in most Livewire scenarios. They're best used for static values defined in the property declaration that you don't want exposed client-side.

For complete information about properties, including persistence behavior and advanced features, see the properties documentation.

#Computed properties
Computed properties are methods that act like memoized properties. They're perfect for expensive operations like database queries:

use Livewire\Attributes\Computed;
 
#[Computed]
public function posts()
{
    return Post::with('author')->latest()->get();
}
<div>
    @foreach ($this->posts as $post)
        <article wire:key="{{ $post->id }}">{{ $post->title }}</article>
    @endforeach
</div>
Notice the $this-> prefix - this tells Livewire to call the method and cache the result for the current request only (not between requests). For more details, see the computed properties section in the properties documentation.

#Passing data from render()
Similar to a controller, you can pass data directly to the view using the render() method:

public function render()
{
    return $this->view([
        'author' => Auth::user(),
        'currentTime' => now(),
    ]);
}
Keep in mind that render() runs on every component update, so avoid expensive operations here unless you need fresh data on every update.

#Organizing components
While Livewire automatically discovers components in the default resources/views/components/ directory, you can customize where Livewire looks for components and organize them using namespaces.

#Component namespaces
Component namespaces allow you to organize components into dedicated directories with a clean reference syntax.

By default, Livewire provides two namespaces:

pages:: — Points to resources/views/pages/
layouts:: — Points to resources/views/layouts/
You can define additional namespaces in your config/livewire.php file:

'component_namespaces' => [
    'layouts' => resource_path('views/layouts'),
    'pages' => resource_path('views/pages'),
    'admin' => resource_path('views/admin'),    // Custom namespace
    'widgets' => resource_path('views/widgets'), // Another custom namespace
],
Then use them when creating, rendering, and routing:

php artisan make:livewire admin::users-table
<livewire:admin::users-table />
Route::livewire('/admin/users', 'admin::users-table');
#Additional component locations
If you want Livewire to discover components in additional directories beyond the defaults, you can configure them in your config/livewire.php file:

'component_paths' => [
    resource_path('views/components'),
    resource_path('views/admin/components'),
    resource_path('views/widgets'),
],
Now Livewire will automatically discover components in all these directories.

#Programmatic registration
For more dynamic scenarios (like package development or runtime configuration), you can register components, locations, and namespaces programmatically in a service provider:

Register an individual component:

use Livewire\Livewire;
 
// In a service provider's boot() method (e.g., App\Providers\AppServiceProvider)
Livewire::addComponent(
    name: 'custom-button',
    viewPath: resource_path('views/ui/button.blade.php')
);
Register a component directory:

Livewire::addLocation(
    viewPath: resource_path('views/admin/components')
);
Register a namespace:

Livewire::addNamespace(
    namespace: 'ui',
    viewPath: resource_path('views/ui')
);
This approach is useful when you need to register components conditionally or when building Laravel packages that provide Livewire components.

#Registering class-based components
For class-based components, use the same methods but with the class parameter instead of path:

use Livewire\Livewire;
 
// In a service provider's boot() method (e.g., App\Providers\AppServiceProvider)
 
// Register an individual class-based component
Livewire::addComponent(
    name: 'todos',
    \App\Livewire\Todos::class
);
 
// Register a location for class-based components
Livewire::addLocation(
    classNamespace: 'App\\Admin\\Livewire'
);
 
// Create a namespace for class-based components
Livewire::addNamespace(
    namespace: 'admin',
    classNamespace: 'App\\Admin\\Livewire',
    classPath: app_path('Admin/Livewire'),
    classViewPath: resource_path('views/admin/livewire')
);
#Class-based components
For teams migrating from Livewire v3 or those who prefer a more traditional Laravel structure, Livewire fully supports class-based components. This approach separates the PHP class and Blade view into different files in their conventional locations.

#Creating class-based components
php artisan make:livewire CreatePost --class
This creates two separate files:

app/Livewire/CreatePost.php

<?php
 
namespace App\Livewire;
 
use Livewire\Component;
 
class CreatePost extends Component
{
    public function render()
    {
        return view('livewire.create-post');
    }
}
resources/views/livewire/create-post.blade.php

<div>
    {{-- ... --}}
</div>
#When to use class-based components
Use class-based components when:

Migrating from Livewire v2/v3
Your team prefers a more traditional file structure
You have established conventions around class-based architecture
Use single-file or multi-file components when:

Starting a new Livewire v4 project
You want better component colocation
You want to use the latest Livewire conventions
#Configuring default component type
If you want class-based components by default, configure it in config/livewire.php:

'make_command' => [
    'type' => 'class',
],
#Customizing component stubs
You can customize the files (or stubs) Livewire uses to generate new components by running:

php artisan livewire:stubs
This creates stub files in your application that you can modify:

Single-file component stubs:

stubs/livewire-sfc.stub — Single-file components
Multi-file component stubs:

stubs/livewire-mfc-class.stub — PHP class for multi-file components
stubs/livewire-mfc-view.stub — Blade view for multi-file components
stubs/livewire-mfc-js.stub — JavaScript for multi-file components
stubs/livewire-mfc-test.stub — Pest test for multi-file components
Class-based component stubs:

stubs/livewire.stub — PHP class for class-based components
stubs/livewire.view.stub — Blade view for class-based components
Additional stubs:

stubs/livewire.attribute.stub — Attribute classes
stubs/livewire.form.stub — Form classes
Once published, Livewire will automatically use your custom stubs when generating new components.

#Troubleshooting
#Component not found
Symptom: Error message like "Component [post.create] not found" or "Unable to find component"

Solutions:

Verify the component file exists at the expected path
Check that the component name in your view matches the file structure (dots for subdirectories)
For namespaced components, ensure the namespace is defined in config/livewire.php or manually registered in a service provider
Try clearing your view cache: php artisan view:clear
#Component shows blank or doesn't render
Common causes:

Missing root element in your Blade template (Livewire requires exactly one root element)
Syntax errors in the PHP section of your component
Check your Laravel logs for detailed error messages
#Class name conflicts
Symptom: Errors about duplicate class names when using single-file components

Solution: This can happen if you have multiple single-file components with the same name in different directories. Either:

Rename one of the components to be unique
Namespace one of the directories for more clear separation
#See also
Properties — Manage component state and data
Actions — Handle user interactions with methods
Pages — Use components as full pages with routing
Nesting — Compose components together and pass data between them
Lifecycle Hooks — Execute code at specific points in a component's lifecycle


Nesting Components
Are you a visual learner?
Master Livewire with our in-depth screencasts
Watch now
Livewire allows you to nest additional Livewire components inside of a parent component. This feature is immensely powerful, as it allows you to re-use and encapsulate behavior within Livewire components that are shared across your application.

You might not need a Livewire component
Before you extract a portion of your template into a nested Livewire component, ask yourself: Does this content in this component need to be "live"? If not, we recommend that you create a simple Blade component instead. Only create a Livewire component if the component benefits from Livewire's dynamic nature or if there is a direct performance benefit.

Consider islands for isolated updates
If you want to isolate re-rendering to specific regions of your component without the overhead of creating separate child components, consider using islands instead. Islands let you create independently-updating regions within a single component without managing props, events, or child component communication.

Consult our in-depth, technical examination of Livewire component nesting for more information on the performance, usage implications, and constraints of nested Livewire components.

#Nesting a component
To nest a Livewire component within a parent component, simply include it in the parent component's Blade view. Below is an example of a dashboard parent component that contains a nested todos component:

<?php // resources/views/components/⚡dashboard.blade.php
 
use Livewire\Component;
 
new class extends Component {
    //
};
?>
 
<div>
    <h1>Dashboard</h1>
 
    <livewire:todos /> 
</div>
On this page's initial render, the dashboard component will encounter <livewire:todos /> and render it in place. On a subsequent network request to dashboard, the nested todos component will skip rendering because it is now its own independent component on the page. For more information on the technical concepts behind nesting and rendering, consult our documentation on why nested components are independent.

For more information about the syntax for rendering components, consult our documentation on Rendering Components.

#Passing props to children
Passing data from a parent component to a child component is straightforward. In fact, it's very much like passing props to a typical Blade component.

For example, let's check out a todos component that passes a collection of $todos to a child component called todo-count:

<?php // resources/views/components/⚡todos.blade.php
 
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
 
new class extends Component {
    #[Computed]
    public function todos()
    {
        return Auth::user()->todos,
    }
};
?>
 
<div>
    <livewire:todo-count :todos="$this->todos" />
 
    <!-- ... -->
</div>
As you can see, we are passing $this->todos into todo-count with the syntax: :todos="$this->todos".

Now that $todos has been passed to the child component, you can receive that data through the child component's mount() method:

<?php // resources/views/components/⚡todo-count.blade.php
 
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Todo;
 
new class extends Component {
    public $todos;
 
    public function mount($todos)
    {
        $this->todos = $todos;
    }
 
    #[Computed]
    public function count()
    {
        return $this->todos->count(),
    }
};
?>
 
<div>
    Count: {{ $this->count }}
</div>
Omitmount() as a shorter alternative
If the mount() method in above example feels like redundant boilerplate code to you, it can be omitted as long as the property and parameter names match:

public $todos; 
#Passing static props
In the previous example, we passed props to our child component using Livewire's dynamic prop syntax, which supports PHP expressions like so:

<livewire:todo-count :todos="$todos" />
However, sometimes you may want to pass a component a simple static value such as a string. In these cases, you may omit the colon from the beginning of the statement:

<livewire:todo-count :todos="$todos" label="Todo Count:" />
Boolean values may be provided to components by only specifying the key. For example, to pass an $inline variable with a value of true to a component, we may simply place inline on the component tag:

<livewire:todo-count :todos="$todos" inline />
#Shortened attribute syntax
When passing PHP variables into a component, the variable name and the prop name are often the same. To avoid writing the name twice, Livewire allows you to simply prefix the variable with a colon:

<livewire:todo-count :todos="$todos" /> 
 
<livewire:todo-count :$todos /> 
#Rendering children in a loop
When rendering a child component within a loop, you should include a unique key value for each iteration.

Component keys are how Livewire tracks each component on subsequent renders, particularly if a component has already been rendered or if multiple components have been re-arranged on the page.

You can specify the component's key by specifying a :key prop on the child component:

<div>
    <h1>Todos</h1>
 
    @foreach ($todos as $todo)
        <livewire:todo-item :$todo :wire:key="$todo->id" />
    @endforeach
</div>
As you can see, each child component will have a unique key set to the ID of each $todo. This ensures the key will be unique and tracked if the todos are re-ordered.

Keys aren't optional
If you have used frontend frameworks like Vue or Alpine, you are familiar with adding a key to a nested element in a loop. However, in those frameworks, a key isn't mandatory, meaning the items will render, but a re-order might not be tracked properly. However, Livewire relies more heavily on keys and will behave incorrectly without them.

#Reactive props
Developers new to Livewire expect that props are "reactive" by default. In other words, they expect that when a parent changes the value of a prop being passed into a child component, the child component will automatically be updated. However, by default, Livewire props are not reactive.

When using Livewire, every component is independent. This means that when an update is triggered on the parent and a network request is dispatched, only the parent component's state is sent to the server to re-render - not the child component's. The intention behind this behavior is to only send the minimal amount of data back and forth between the server and client, making updates as performant as possible.

But, if you want or need a prop to be reactive, you can easily enable this behavior using the #[Reactive] attribute parameter.

For example, below is the template of a parent todos component. Inside, it is rendering a todo-count component and passing in the current list of todos:

<div>
    <h1>Todos:</h1>
 
    <livewire:todo-count :$todos />
 
    <!-- ... -->
</div>
Now let's add #[Reactive] to the $todos prop in the todo-count component. Once we have done so, any todos that are added or removed inside the parent component will automatically trigger an update within the todo-count component:

<?php // resources/views/components/⚡todo-count.blade.php
 
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Todo;
 
new class extends Component {
    #[Reactive] 
    public $todos;
 
    #[Computed]
    public function count()
    {
        return $this->todos->count(),
    }
};
?>
 
<div>
    Count: {{ $this->count }}
</div>
Reactive properties are an incredibly powerful feature, making Livewire more similar to frontend component libraries like Vue and React. But, it is important to understand the performance implications of this feature and only add #[Reactive] when it makes sense for your particular scenario.

Islands can eliminate the need for reactive props
If you find yourself creating child components primarily to isolate updates and using #[Reactive] to keep them in sync, consider using islands instead. Islands provide isolated re-rendering within a single component without the need for reactive props or child component communication.

#Binding to child data using wire:model
Another powerful pattern for sharing state between parent and child components is using wire:model directly on a child component via Livewire's Modelable feature.

This behavior is very commonly needed when extracting an input element into a dedicated Livewire component while still accessing its state in the parent component.

Below is an example of a parent todos component that contains a $todo property which tracks the current todo about to be added by a user:

<?php // resources/views/components/⚡todos.blade.php
 
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Todo;
 
new class extends Component {
    public $todo = '';
 
    public function add()
    {
        Todo::create([
            'content' => $this->pull('todo'),
        ]);
    }
 
    #[Computed]
    public function todos()
    {
        return Auth::user()->todos,
    }
};
As you can see in the todos template, wire:model is being used to bind the $todo property directly to a nested todo-input component:

<div>
    <h1>Todos</h1>
 
    <livewire:todo-input wire:model="todo" /> 
 
    <button wire:click="add">Add Todo</button>
 
    <div>
        @foreach ($this->todos as $todo)
            <livewire:todo-item :$todo :wire:key="$todo->id" />
        @endforeach
    </div>
</div>
Livewire provides a #[Modelable] attribute you can add to any child component property to make it modelable from a parent component.

Below is the todo-input component with the #[Modelable] attribute added above the $value property to signal to Livewire that if wire:model is declared on the component by a parent it should bind to this property:

<?php // resources/views/components/⚡todo-input.blade.php
 
use Livewire\Attributes\Modelable;
use Livewire\Component;
 
new class extends Component {
    #[Modelable] 
    public $value = '';
};
?>
 
<div>
    <input type="text" wire:model="value" >
</div>
Now the parent todos component can treat todo-input like any other input element and bind directly to its value using wire:model.

Currently Livewire only supports a single #[Modelable] attribute, so only the first one will be bound.

#Slots
Slots allow you to pass Blade content from a parent component into a child component. This is useful when a child component needs to render its own content while also allowing the parent to inject custom content in specific places.

Below is an example of a parent component that renders a list of comments. Each comment is rendered by a Comment child component, but the parent passes in a "Remove" button via a slot:

<?php
 
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Post;
 
new class extends Component {
    public Post $post;
 
    #[Computed]
    public function comments()
    {
        return $this->post->comments;
    }
 
    public function removeComment($id)
    {
        $this->post->comments()->find($id)->delete();
    }
};
?>
 
<div>
    @foreach ($this->comments as $comment)
        <livewire:comment :$comment :wire:key="$comment->id">
            <button wire:click="removeComment({{ $comment->id }})">
                Remove
            </button>
        </livewire:comment>
    @endforeach
</div>
Now that content has been passed to the Comment child component, you can render it using the $slot variable:

<?php
 
use Livewire\Component;
use App\Models\Comment;
 
new class extends Component {
    public Comment $comment;
};
?>
 
<div>
    <p>{{ $comment->author }}</p>
    <p>{{ $comment->body }}</p>
 
    {{ $slot }}
</div>
When the Comment component renders $slot, Livewire will inject the content passed from the parent.

It's important to understand that slots are evaluated in the context of the parent component. This means any properties or methods referenced inside the slot belong to the parent, not the child. In the example above, the removeComment() method is called on the parent component, not the Comment child.

#Named slots
In addition to the default slot, you may also pass multiple named slots into a child component. This is useful when you want to provide content for multiple areas of a child component.

Below is an example of passing both a default slot and a named actions slot to the Comment component:

<div>
    @foreach ($this->comments as $comment)
        <livewire:comment :$comment :wire:key="$comment->id">
            <livewire:slot name="actions">
                <button wire:click="removeComment({{ $comment->id }})">
                    Remove
                </button>
            </livewire:slot>
 
            <span>Posted on {{ $comment->created_at }}</span>
        </livewire:comment>
    @endforeach
</div>
You can access named slots in the child component by passing the slot name to the $slot variable:

<div>
    <p>{{ $comment->author }}</p>
    <p>{{ $comment->body }}</p>
 
    <div class="actions">
        {{ $slot('actions') }}
    </div>
 
    <div class="metadata">
        {{ $slot }}
    </div>
</div>
#Checking if a slot was provided
You can check if a slot was provided by the parent using the has() method on the $slot variable. This is helpful when you want to conditionally render content based on whether or not a slot is present:

<div>
    <p>{{ $comment->author }}</p>
    <p>{{ $comment->body }}</p>
 
    @if ($slot->has('actions'))
        <div class="actions">
            {{ $slot('actions') }}
        </div>
    @endif
 
    {{ $slot }}
</div>
#Forwarding HTML attributes
Like Blade components, Livewire components support forwarding HTML attributes from a parent to a child using the $attributes variable.

Below is an example of a parent component passing a class attribute to a child component:

<livewire:comment :$comment class="border-b" />
You can apply these attributes in the child component using the $attributes variable:

<div {{ $attributes->class('bg-white rounded-md') }}>
    <p>{{ $comment->author }}</p>
    <p>{{ $comment->body }}</p>
</div>
Attributes that match public property names are automatically passed as props and excluded from $attributes. Any remaining attributes like class, id, or data-* are available through $attributes.

#Islands vs nested components
When building Livewire applications, you'll often face a choice: Should you create a nested child component or use an island? Both approaches allow you to isolate updates to specific regions, but they serve different purposes.

#When to use islands
Islands are ideal when you want performance isolation without architectural complexity. Use islands when:

You need performance optimization without the overhead

If your primary goal is to prevent expensive computations from running unnecessarily, islands are the simpler solution:

{{-- Island: Simple performance isolation --}}
@island
    <div>
        Revenue: {{ $this->expensiveRevenue }}
        <button wire:click="$refresh">Refresh</button>
    </div>
@endisland
This achieves the same performance benefit as a child component, but without creating a separate component file, managing props, or setting up event communication.

You want to defer or lazy load content

Islands excel at deferring expensive operations until after the initial page load:

@island(lazy: true)
    <div>{{ $this->slowApiCall }}</div>
@endisland
You have multiple independent UI regions

When you have several regions that update independently but don't need separate logic:

@island(name: 'stats')
    <div>Stats: {{ $this->stats }}</div>
@endisland
 
@island(name: 'chart')
    <div>Chart: {{ $this->chartData }}</div>
@endisland
The isolated region doesn't need its own lifecycle

Islands share the parent component's lifecycle, state, and methods. This is perfect when the region is conceptually part of the same component.

#When to use nested components
Nested components are better when you need true encapsulation and reusability. Use nested components when:

You need reusable, self-contained functionality

If the component will be used in multiple places with its own logic and state:

{{-- This todo-item can be reused across the application --}}
<livewire:todo-item :$todo :wire:key="$todo->id" />
You need separate lifecycle hooks

When the child needs its own mount(), updated(), or other lifecycle methods:

public function mount($todo)
{
    $this->authorize('view', $todo);
}
 
public function updated($property)
{
    // Child-specific update logic
}
You need encapsulated state and logic

When the child has complex state management that should be isolated:

// Child component with its own encapsulated state
public $editMode = false;
public $draft = '';
 
public function startEdit() { /* ... */ }
public function saveEdit() { /* ... */ }
public function cancelEdit() { /* ... */ }
You need the component to be truly independent

Nested components are truly independent, maintaining their own state across parent updates. This is valuable when you don't want parent re-renders to affect the child.

You're building a component library

When creating reusable components for your team or organization, nested components provide the proper encapsulation boundaries.

#Quick decision guide
Still not sure? Ask yourself:

"Does this need to be reusable?" → Nested component
"Does this need its own lifecycle methods?" → Nested component
"Am I just trying to optimize performance?" → Island
"Do I want to defer loading expensive content?" → Island (with lazy or defer)
"Will this be used in one place only?" → Probably an island
"Does this need complex, isolated state?" → Nested component
Remember: You can always start with an island for simplicity and refactor to a nested component later if you need the additional encapsulation.

#Listening for events from children
Another powerful parent-child component communication technique is Livewire's event system, which allows you to dispatch an event on the server or client that can be intercepted by other components.

Our complete documentation on Livewire's event system provides more detailed information on events, but below we'll discuss a simple example of using an event to trigger an update in a parent component.

Consider a todos component with functionality to show and remove todos:

<?php // resources/views/components/⚡todos.blade.php
 
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Todo;
 
new class extends Component {
    public function remove($todoId)
    {
        $todo = Todo::find($todoId);
 
        $this->authorize('delete', $todo);
 
        $todo->delete();
    }
 
    #[Computed]
    public function todos()
    {
        return Auth::user()->todos,
    }
};
?>
 
<div>
    @foreach ($this->todos as $todo)
        <livewire:todo-item :$todo :wire:key="$todo->id" />
    @endforeach
</div>
To call remove() from inside the child todo-item components, you can add an event listener to todos via the #[On] attribute:

<?php // resources/views/components/⚡todos.blade.php
 
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Todo;
 
new class extends Component {
    #[On('remove-todo')] 
    public function remove($todoId)
    {
        $todo = Todo::find($todoId);
 
        $this->authorize('delete', $todo);
 
        $todo->delete();
    }
 
    #[Computed]
    public function todos()
    {
        return Auth::user()->todos,
    }
};
?>
 
<div>
    @foreach ($this->todos as $todo)
        <livewire:todo-item :$todo :wire:key="$todo->id" />
    @endforeach
</div>
Once the attribute has been added to the action, you can dispatch the remove-todo event from the todo-item child component:

<?php // resources/views/components/⚡todo-item.blade.php
 
use Livewire\Component;
use App\Models\Todo;
 
new class extends Component {
    public Todo $todo;
 
    public function remove()
    {
        $this->dispatch('remove-todo', todoId: $this->todo->id); 
    }
};
?>
 
<div>
    <span>{{ $todo->content }}</span>
 
    <button wire:click="remove">Remove</button>
</div>
Now when the "Remove" button is clicked inside a todo-item, the parent todos component will intercept the dispatched event and perform the todo removal.

After the todo is removed in the parent, the list will be re-rendered and the child that dispatched the remove-todo event will be removed from the page.

#Improving performance by dispatching client-side
Though the above example works, it takes two network requests to perform a single action:

The first network request from the todo-item component triggers the remove action, dispatching the remove-todo event.
The second network request is after the remove-todo event is dispatched client-side and is intercepted by todos to call its remove action.
You can avoid the first request entirely by dispatching the remove-todo event directly on the client-side. Below is an updated todo-item component that does not trigger a network request when dispatching the remove-todo event:

<?php // resources/views/components/⚡todo-item.blade.php
 
use Livewire\Component;
use App\Models\Todo;
 
new class extends Component {
    public Todo $todo;
};
?>
 
<div>
    <span>{{ $todo->content }}</span>
 
    <button wire:click="$dispatch('remove-todo', { todoId: {{ $todo->id }} })">Remove</button>
</div>
As a rule of thumb, always prefer dispatching client-side when possible.

Islands eliminate event communication overhead
If you're creating child components primarily to trigger parent updates via events, consider using islands instead. Islands can call component methods directly without the indirection of events, since they share the same component context.

#Directly accessing the parent from the child
Event communication adds a layer of indirection. A parent can listen for an event that never gets dispatched from a child, and a child can dispatch an event that is never intercepted by a parent.

This indirection is sometimes desirable; however, in other cases you may prefer to access a parent component directly from the child component.

Livewire allows you to accomplish this by providing a magic $parent variable to your Blade template that you can use to access actions and properties directly from the child. Here's the above TodoItem template rewritten to call the remove() action directly on the parent via the magic $parent variable:

<div>
    <span>{{ $todo->content }}</span>
 
    <button wire:click="$parent.remove({{ $todo->id }})">Remove</button>
</div>
Events and direct parent communication are a few of the ways to communicate back and forth between parent and child components. Understanding their tradeoffs enables you to make more informed decisions about which pattern to use in a particular scenario.

#Dynamic child components
Sometimes, you may not know which child component should be rendered on a page until run-time. Therefore, Livewire allows you to choose a child component at run-time via <livewire:dynamic-component ...>, which receives an :is prop:

<livewire:dynamic-component :is="$current" />
Dynamic child components are useful in a variety of different scenarios, but below is an example of rendering different steps in a multi-step form using a dynamic component:

<?php // resources/views/components/⚡steps.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $current = 'step-one';
 
    protected $steps = [
        'step-one',
        'step-two',
        'step-three',
    ];
 
    public function next()
    {
        $currentIndex = array_search($this->current, $this->steps);
 
        $this->current = $this->steps[$currentIndex + 1];
    }
};
?>
 
<div>
    <livewire:dynamic-component :is="$current" :wire:key="$current" />
 
    <button wire:click="next">Next</button>
</div>
Now, if the steps component's $current prop is set to "step-one", Livewire will render a component named "step-one" like so:

<?php // resources/views/components/⚡step-one.blade.php
 
use Livewire\Component;
 
new class extends Component {
    //
};
?>
 
<div>
    Step One Content
</div>
If you prefer, you can use the alternative syntax:

<livewire:is :component="$current" :wire:key="$current" />
Don't forget to assign each child component a unique key. Although Livewire automatically generates a key for <livewire:dynamic-child /> and <livewire:is />, that same key will apply to all your child components, meaning subsequent renders will be skipped.

See forcing a child component to re-render for a deeper understanding of how keys affect component rendering.

#Recursive components
Although rarely needed by most applications, Livewire components may be nested recursively, meaning a parent component renders itself as its child.

Imagine a survey which contains a survey-question component that can have sub-questions attached to itself:

<?php // resources/views/components/⚡survey-question.blade.php
 
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Question;
 
new class extends Component {
    public Question $question;
 
    #[Computed]
    public function subQuestions()
    {
        return $this->question->subQuestions,
    }
};
?>
 
<div>
    Question: {{ $question->content }}
 
    @foreach ($this->subQuestions as $subQuestion)
        <livewire:survey-question :question="$subQuestion" :wire:key="$subQuestion->id" />
    @endforeach
</div>
Of course, the standard rules of recursion apply to recursive components. Most importantly, you should have logic in your template to ensure the template doesn't recurse indefinitely. In the example above, if a $subQuestion contained the original question as its own $subQuestion, an infinite loop would occur.

#Forcing a child component to re-render
Behind the scenes, Livewire generates a key for each nested Livewire component in its template.

For example, consider the following nested todo-count component:

<div>
    <livewire:todo-count :$todos />
</div>
Livewire internally attaches a random string key to the component like so:

<div>
    <livewire:todo-count :$todos wire:key="lska" />
</div>
When the parent component is rendering and encounters a child component like the above, it stores the key in a list of children attached to the parent:

'children' => ['lska'],
Livewire uses this list for reference on subsequent renders in order to detect if a child component has already been rendered in a previous request. If it has already been rendered, the component is skipped. Remember, nested components are independent. However, if the child key is not in the list, meaning it hasn't been rendered already, Livewire will create a new instance of the component and render it in place.

These nuances are all behind-the-scenes behavior that most users don't need to be aware of; however, the concept of setting a key on a child is a powerful tool for controlling child rendering.

Using this knowledge, if you want to force a component to re-render, you can simply change its key.

Below is an example where we might want to destroy and re-initialize the todo-count component if the $todos being passed to the component are changed:

<div>
    <livewire:todo-count :todos="$todos" :wire:key="$todos->pluck('id')->join('-')" />
</div>
As you can see above, we are generating a dynamic :key string based on the content of $todos. This way, the todo-count component will render and exist as normal until the $todos themselves change. At that point, the component will be re-initialized entirely from scratch, and the old component will be discarded.

#See also
Events — Communicate between nested components
Components — Learn about rendering and organizing components
Islands — Alternative to nesting for isolated updates
Understanding Nesting — Deep dive into nesting performance and behavior
Reactive Attribute — Make props reactive in nested components

Js
Are you a visual learner?
Master Livewire with our in-depth screencasts
Watch now
The #[Js] attribute designates methods that return JavaScript code to be executed on the client-side, providing a way to trigger client-side behavior from server-side actions.

#Basic usage
Apply the #[Js] attribute to methods that return JavaScript expressions:

<?php // resources/views/components/post/⚡create.blade.php
 
use Livewire\Attributes\Js;
use Livewire\Component;
use App\Models\Post;
 
new class extends Component {
    public $title = '';
 
    public function save()
    {
        Post::create(['title' => $this->title]);
 
        return $this->showSuccessMessage(); 
    }
 
    #[Js] 
    public function showSuccessMessage()
    {
        return "alert('Post saved successfully!')";
    } 
};
When the save() action completes, the JavaScript expression alert('Post saved successfully!') will execute on the client.

#Alternative: Using js() method
Instead of the #[Js] attribute, you can use the js() method for one-off JavaScript expressions:

<?php // resources/views/components/post/⚡create.blade.php
 
use Livewire\Component;
use App\Models\Post;
 
new class extends Component {
    public $title = '';
 
    public function save()
    {
        Post::create(['title' => $this->title]);
 
        $this->js("alert('Post saved successfully!')"); 
    }
};
The js() method is more concise for simple expressions, while #[Js] methods are better for reusable or complex JavaScript logic.

#Accessing $wire
You can access the component's $wire object inside JavaScript expressions:

#[Js]
public function resetForm()
{
    return <<<'JS'
        $wire.title = ''
        $wire.content = ''
        alert('Form has been reset')
    JS;
}
#When to use
Use #[Js] when you need to:

Show client-side alerts or notifications after server actions
Trigger JavaScript animations or transitions
Update client-side state without re-rendering
Execute reusable JavaScript logic from multiple places
Integrate with third-party JavaScript libraries
#JavaScript actions vs #[Js] methods
There's an important distinction:

JavaScript actions ($js.methodName) run entirely on the client without making a server request
#[Js] methods run on the server first, then execute the returned JavaScript on the client
<?php // resources/views/components/⚡example.blade.php
 
use Livewire\Attributes\Js;
use Livewire\Component;
 
new class extends Component {
    public $count = 0;
 
    // Server-side method that returns JavaScript
    #[Js]
    public function showCount()
    {
        return "alert('Count is: {$this->count}')";
    }
};
<div>
    <button wire:click="showCount">Show Count</button>
</div>
 
<script>
    // Pure client-side JavaScript action
    this.$js.incrementLocal = () => {
        console.log('No server request made')
    }
</script>

Properties
Are you a visual learner?
Master Livewire with our in-depth screencasts
Watch now
Properties store and manage state inside your Livewire components. They are defined as public properties on component classes and can be accessed and modified on both the server and client-side.

#Initializing properties
You can set initial values for properties within your component's mount() method.

Consider the following example:

<?php // resources/views/components/⚡todos.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $todos = [];
 
    public $todo = '';
 
    public function mount()
    {
        $this->todos = ['Buy groceries', 'Walk the dog', 'Write code']; 
    }
 
    // ...
};
In this example, we've defined an empty todos array and initialized it with a default list of todos in the mount() method. Now, when the component renders for the first time, these initial todos are shown to the user.

#Bulk assignment
Sometimes initializing many properties in the mount() method can feel verbose. To help with this, Livewire provides a convenient way to assign multiple properties at once via the fill() method. By passing an associative array of property names and their respective values, you can set several properties simultaneously and cut down on repetitive lines of code in mount().

For example:

<?php // resources/views/components/post/⚡edit.blade.php
 
use Livewire\Component;
use App\Models\Post;
 
new class extends Component {
    public $post;
 
    public $title;
 
    public $description;
 
    public function mount(Post $post)
    {
        $this->post = $post;
 
        $this->fill( 
            $post->only('title', 'description'), 
        ); 
    }
 
    // ...
};
Because $post->only(...) returns an associative array of model attributes and values based on the names you pass into it, the $title and $description properties will be initially set to the title and description of the $post model from the database without having to set each one individually.

#Data binding
Livewire supports two-way data binding through the wire:model HTML attribute. This allows you to easily synchronize data between component properties and HTML inputs, keeping your user interface and component state in sync.

Let's use the wire:model directive to bind the $todo property in a todos component to a basic input element:

<?php // resources/views/components/⚡todos.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $todos = [];
 
    public $todo = '';
 
    public function add()
    {
        $this->todos[] = $this->todo;
 
        $this->todo = '';
    }
 
    // ...
};
<div>
    <input type="text" wire:model="todo" placeholder="Todo..."> 
 
    <button wire:click="add">Add Todo</button>
 
    <ul>
        @foreach ($todos as $todo)
            <li wire:key="{{ $loop->index }}">{{ $todo }}</li>
        @endforeach
    </ul>
</div>
In the above example, the text input's value will synchronize with the $todo property on the server when the "Add Todo" button is clicked.

This is just scratching the surface of wire:model. For deeper information on data binding, check out our documentation on forms.

#Resetting properties
Sometimes, you may need to reset your properties back to their initial state after an action is performed by the user. In these cases, Livewire provides a reset() method that accepts one or more property names and resets their values to their initial state.

In the example below, we can avoid code duplication by using $this->reset() to reset the todo field after the "Add Todo" button is clicked:

<?php // resources/views/components/⚡todos.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $todos = [];
 
    public $todo = '';
 
    public function addTodo()
    {
        $this->todos[] = $this->todo;
 
        $this->reset('todo'); 
    }
 
    // ...
};
In the above example, after a user clicks "Add Todo", the input field holding the todo that has just been added will clear, allowing the user to write a new todo.

reset() won't work on values set in mount()
reset() will reset a property to its state before the mount() method was called. If you initialized the property in mount() to a different value, you will need to reset the property manually.

#Pulling properties
Alternatively, you can use the pull() method to both reset and retrieve the value in one operation.

Here's the same example from above, but simplified with pull():

<?php // resources/views/components/⚡todos.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $todos = [];
 
    public $todo = '';
 
    public function addTodo()
    {
        $this->todos[] = $this->pull('todo'); 
    }
 
    // ...
};
The above example is pulling a single value, but pull() can also be used to reset and retrieve (as a key-value pair) all or some properties:

// The same as $this->all() and $this->reset();
$this->pull();
 
// The same as $this->only(...) and $this->reset(...);
$this->pull(['title', 'content']);
#Supported property types
Livewire supports a limited set of property types because of its unique approach to managing component data between server requests.

Each property in a Livewire component is serialized or "dehydrated" into JSON between requests, then "hydrated" from JSON back into PHP for the next request.

This two-way conversion process has certain limitations, restricting the types of properties Livewire can work with.

#Primitive types
Livewire supports primitive types such as strings, integers, etc. These types can be easily converted to and from JSON, making them ideal for use as properties in Livewire components.

Livewire supports the following primitive property types: Array, String, Integer, Float, Boolean, and Null.

new class extends Component {
    public array $todos = [];
 
    public string $todo = '';
 
    public int $maxTodos = 10;
 
    public bool $showTodos = false;
 
    public ?string $todoFilter = null;
};
#Common PHP types
In addition to primitive types, Livewire supports common PHP object types used in Laravel applications. However, it's important to note that these types will be dehydrated into JSON and hydrated back to PHP on each request. This means that the property may not preserve run-time values such as closures. Also, information about the object such as class names may be exposed to JavaScript.

Supported PHP types:

Type	Full Class Name
BackedEnum	BackedEnum
Collection	Illuminate\Support\Collection
Eloquent Collection	Illuminate\Database\Eloquent\Collection
Model	Illuminate\Database\Eloquent\Model
DateTime	DateTime
Carbon	Carbon\Carbon
Stringable	Illuminate\Support\Stringable
Eloquent Collections and Models
When storing Eloquent Collections and Models in Livewire properties, be aware of these limitations:

Query constraints aren't preserved: Additional query constraints like select(...) will not be re-applied on subsequent requests. See Eloquent constraints aren't preserved between requests for details.
Performance impact: Storing large Eloquent collections as properties can cause performance issues because Livewire must re-execute the database query every time the component hydrates. For expensive queries, consider using computed properties instead, which only execute when the data is actually accessed in your template.
Here's a quick example of setting properties as these various types:

public function mount()
{
    $this->todos = collect([]); // Collection
 
    $this->todos = Todos::all(); // Eloquent Collection
 
    $this->todo = Todos::first(); // Model
 
    $this->date = new DateTime('now'); // DateTime
 
    $this->date = new Carbon('now'); // Carbon
 
    $this->todo = str(''); // Stringable
}
#Supporting custom types
Livewire allows your application to support custom types through two powerful mechanisms:

Wireables
Synthesizers
Wireables are simple and easy to use for most applications, so we'll explore them below. If you're an advanced user or package author wanting more flexibility, Synthesizers are the way to go.

#Wireables
Wireables are any class in your application that implements the Wireable interface.

For example, let's imagine you have a Customer object in your application that contains the primary data about a customer:

class Customer
{
    protected $name;
    protected $age;
 
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
}
Attempting to set an instance of this class to a Livewire component property will result in an error telling you that the Customer property type isn't supported:

new class extends Component {
    public Customer $customer;
 
    public function mount()
    {
        $this->customer = new Customer('Caleb', 29);
    }
};
However, you can solve this by implementing the Wireable interface and adding a toLivewire() and fromLivewire() method to your class. These methods tell Livewire how to turn properties of this type into JSON and back again:

use Livewire\Wireable;
 
class Customer implements Wireable
{
    protected $name;
    protected $age;
 
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
 
    public function toLivewire()
    {
        return [
            'name' => $this->name,
            'age' => $this->age,
        ];
    }
 
    public static function fromLivewire($value)
    {
        $name = $value['name'];
        $age = $value['age'];
 
        return new static($name, $age);
    }
}
Now you can freely set Customer objects on your Livewire components and Livewire will know how to convert these objects into JSON and back into PHP.

As mentioned earlier, if you want to support types more globally and powerfully, Livewire offers Synthesizers, its advanced internal mechanism for handling different property types. Learn more about Synthesizers.

#Accessing properties from JavaScript
Because Livewire properties are also available in the browser via JavaScript, you can access and manipulate their JavaScript representations from AlpineJS.

Alpine is a lightweight JavaScript library that is included with Livewire. Alpine provides a way to build lightweight interactions into your Livewire components without making full server roundtrips.

Internally, Livewire's frontend is built on top of Alpine. In fact, every Livewire component is actually an Alpine component under-the-hood. This means that you can freely utilize Alpine inside your Livewire components.

The rest of this page assumes a basic familiarity with Alpine. If you're unfamiliar with Alpine, take a look at the Alpine documentation.

#Accessing properties
Livewire exposes a magic $wire object to Alpine. You can access the $wire object from any Alpine expression inside your Livewire component.

The $wire object can be treated like a JavaScript version of your Livewire component. It has all the same properties and methods as the PHP version of your component, but also contains a few dedicated methods to perform specific functions in your template.

For example, we can use $wire to show a live character count of the todo input field:

<div>
    <input type="text" wire:model="todo">
 
    Todo character length: <h2 x-text="$wire.todo.length"></h2>
</div>
As the user types in the field, the character length of the current todo being written will be shown and live-updated on the page, all without sending a network request to the server.

#Manipulating properties
Similarly, you can manipulate your Livewire component properties in JavaScript using $wire.

For example, let's add a "Clear" button to the todos component to allow the user to reset the input field using only JavaScript:

<div>
    <input type="text" wire:model="todo">
 
    <button x-on:click="$wire.todo = ''">Clear</button>
</div>
After the user clicks "Clear", the input will be reset to an empty string, without sending a network request to the server.

On the subsequent request, the server-side value of $todo will be updated and synchronized.

If you prefer, you can also use the more explicit .set() method for setting properties client-side. However, you should note that using .set() by default immediately triggers a network request and synchronizes the state with the server. If that is desired, then this is an excellent API:

<button x-on:click="$wire.set('todo', '')">Clear</button>
In order to update the property without sending a network request to the server, you can pass a third bool parameter. This will defer the network request and on a subsequent request, the state will be synchronized on the server-side:

<button x-on:click="$wire.set('todo', '', false)">Clear</button>
#Security concerns
While Livewire properties are a powerful feature, there are a few security considerations that you should be aware of before using them.

In short, always treat public properties as user input — as if they were request input from a traditional endpoint. In light of this, it's essential to validate and authorize properties before persisting them to a database — just like you would do when working with request input in a controller.

#Don't trust property values
To demonstrate how neglecting to authorize and validate properties can introduce security holes in your application, the following post.edit component is vulnerable to attack:

<?php // resources/views/components/post/⚡edit.blade.php
 
use Livewire\Component;
use App\Models\Post;
 
new class extends Component {
    public $id;
    public $title;
    public $content;
 
    public function mount(Post $post)
    {
        $this->id = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
    }
 
    public function update()
    {
        $post = Post::findOrFail($this->id);
 
        $post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);
 
        session()->flash('message', 'Post updated successfully!');
    }
};
<form wire:submit="update">
    <input type="text" wire:model="title">
    <input type="text" wire:model="content">
 
    <button type="submit">Update</button>
</form>
At first glance, this component may look completely fine. But, let's walk through how an attacker could use the component to do unauthorized things in your application.

Because we are storing the id of the post as a public property on the component, it can be manipulated on the client just the same as the title and content properties.

It doesn't matter that we didn't write an input with wire:model="id". A malicious user can easily change the view to the following using their browser DevTools:

<form wire:submit="update">
    <input type="text" wire:model="id"> 
    <input type="text" wire:model="title">
    <input type="text" wire:model="content">
 
    <button type="submit">Update</button>
</form>
Now the malicious user can update the id input to the ID of a different post model. When the form is submitted and update() is called, Post::findOrFail() will return and update a post the user is not the owner of.

To prevent this kind of attack, we can use one or both of the following strategies:

Authorize the input
Lock the property from updates
#Authorizing the input
Because $id can be manipulated client-side with something like wire:model, just like in a controller, we can use Laravel's authorization to make sure the current user can update the post:

public function update()
{
    $post = Post::findOrFail($this->id);
 
    $this->authorize('update', $post); 
 
    $post->update(...);
}
If a malicious user mutates the $id property, the added authorization will catch it and throw an error.

#Locking the property
Livewire also allows you to "lock" properties in order to prevent properties from being modified on the client-side. You can "lock" a property from client-side manipulation using the #[Locked] attribute:

use Livewire\Attributes\Locked;
use Livewire\Component;
 
new class extends Component {
    #[Locked] 
    public $id;
 
    // ...
};
Now, if a user tries to modify $id on the front end, an error will be thrown.

By using #[Locked], you can assume this property has not been manipulated anywhere outside your component's class.

For more information on locking properties, consult the Locked attribute documentation.

#Eloquent models and locking
When an Eloquent model is assigned to a Livewire component property, Livewire will automatically lock the property and ensure the ID isn't changed, so that you are safe from these kinds of attacks:

<?php // resources/views/components/post/⚡edit.blade.php
 
use Livewire\Component;
use App\Models\Post;
 
new class extends Component {
    public Post $post; 
    public $title;
    public $content;
 
    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }
 
    public function update()
    {
        $this->post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);
 
        session()->flash('message', 'Post updated successfully!');
    }
};
#Properties expose system information to the browser
Another essential thing to remember is that Livewire properties are serialized or "dehydrated" before they are sent to the browser. This means that their values are converted to a format that can be sent over the wire and understood by JavaScript. This format can expose information about your application to the browser, including the names and class names of your properties.

For example, suppose you have a Livewire component that defines a public property named $post. This property contains an instance of a Post model from your database. In this case, the dehydrated value of this property sent over the wire might look something like this:

{
    "type": "model",
    "class": "App\Models\Post",
    "key": 1,
    "relationships": []
}
As you can see, the dehydrated value of the $post property includes the class name of the model (App\Models\Post) as well as the ID and any relationships that have been eager-loaded.

If you don't want to expose the class name of the model, you can use Laravel's "morphMap" functionality from a service provider to assign an alias to a model class name:

<?php
 
namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
 
class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            'post' => 'App\Models\Post',
        ]);
    }
}
Now, when the Eloquent model is "dehydrated" (serialized), the original class name won't be exposed, only the "post" alias:

{
    "type": "model",
    "class": "App\Models\Post", 
    "class": "post", 
    "key": 1,
    "relationships": []
}
#Eloquent constraints aren't preserved between requests
Typically, Livewire is able to preserve and recreate server-side properties between requests; however, there are certain scenarios where preserving values are impossible between requests.

For example, when storing Eloquent collections as Livewire properties, additional query constraints like select(...) will not be re-applied on subsequent requests.

To demonstrate, consider the following show-todos component with a select() constraint applied to the Todos Eloquent collection:

<?php // resources/views/components/⚡show-todos.blade.php
 
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
 
new class extends Component {
    public $todos;
 
    public function mount()
    {
        $this->todos = Auth::user()
            ->todos()
            ->select(['title', 'content']) 
            ->get();
    }
};
When this component is initially loaded, the $todos property will be set to an Eloquent collection of the user's todos; however, only the title and content fields of each row in the database will have been queried and loaded into each of the models.

When Livewire hydrates the JSON of this property back into PHP on a subsequent request, the select constraint will have been lost.

To ensure the integrity of Eloquent queries, we recommend that you use computed properties instead of properties.

Computed properties are methods in your component marked with the #[Computed] attribute. They can be accessed as a dynamic property that isn't stored as part of the component's state but is instead evaluated on-the-fly.

Here's the above example re-written using a computed property:

<?php // resources/views/components/⚡show-todos.blade.php
 
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
 
new class extends Component {
    #[Computed] 
    public function todos()
    {
        return Auth::user()
            ->todos()
            ->select(['title', 'content'])
            ->get();
    }
};
Here's how you would access these todos from the Blade view:

<ul>
    @foreach ($this->todos as $todo)
        <li wire:key="{{ $loop->index }}">{{ $todo }}</li>
    @endforeach
</ul>
Notice, inside your views, you can only access computed properties on the $this object like so: $this->todos.

You can also access $todos from inside your class. For example, if you had a markAllAsComplete() action:

<?php // resources/views/components/⚡show-todos.blade.php
 
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
 
new class extends Component {
    #[Computed]
    public function todos()
    {
        return Auth::user()
            ->todos()
            ->select(['title', 'content'])
            ->get();
    }
 
    public function markAllComplete() 
    {
        $this->todos->each->complete();
    }
};
You might wonder why not just call $this->todos() as a method directly where you need to? Why use #[Computed] in the first place?

The reason is that computed properties have a performance advantage, since they are automatically memoized after their first usage during a single request. This means you can freely access $this->todos within your component and be assured that the actual method will only be called once, so that you don't run an expensive query multiple times in the same request.

Events
Are you a visual learner?
Master Livewire with our in-depth screencasts
Watch now
Livewire offers a robust event system that you can use to communicate between different components on the page. Because it uses browser events under the hood, you can also use Livewire's event system to communicate with Alpine components or even plain, vanilla JavaScript.

To trigger an event, you may use the dispatch() method from anywhere inside your component and listen for that event from any other component on the page.

#Dispatching events
To dispatch an event from a Livewire component, you can call the dispatch() method, passing it the event name and any additional data you want to send along with the event.

Below is an example of dispatching a post-created event from a post.create component:

<?php // resources/views/components/post/⚡create.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public function save()
    {
        // ...
 
        $this->dispatch('post-created'); 
    }
};
In this example, when the dispatch() method is called, the post-created event will be dispatched, and every other component on the page that is listening for this event will be notified.

You can pass additional data with the event by passing the data as the second parameter to the dispatch() method:

$this->dispatch('post-created', title: $post->title);
#Listening for events
To listen for an event in a Livewire component, add the #[On] attribute above the method you want to be called when a given event is dispatched:

Make sure you import attribute classes
Make sure you import any attribute classes. For example, the below #[On()] attributes requires the following import use Livewire\Attributes\On;.

<?php // resources/views/components/⚡dashboard.blade.php
 
use Livewire\Component;
use Livewire\Attributes\On; 
 
new class extends Component {
    #[On('post-created')] 
    public function updatePostList($title)
    {
        // ...
    }
};
Now, when the post-created event is dispatched from post.create, a network request will be triggered and the updatePostList() action will be invoked.

As you can see, additional data sent with the event will be provided to the action as its first argument.

#Listening for dynamic event names
Occasionally, you may want to dynamically generate event listener names at run-time using data from your component.

For example, if you wanted to scope an event listener to a specific Eloquent model, you could append the model's ID to the event name when dispatching like so:

<?php // resources/views/components/post/⚡edit.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public function update()
    {
        // ...
 
        $this->dispatch("post-updated.{$post->id}"); 
    }
};
And then listen for that specific model:

<?php // resources/views/components/post/⚡show.blade.php
 
use Livewire\Attributes\On; 
use Livewire\Component;
use App\Models\Post;
 
new class extends Component {
    public Post $post;
 
    #[On('post-updated.{post.id}')] 
    public function refreshPost()
    {
        // ...
    }
};
If the above $post model had an ID of 3, the refreshPost() method would only be triggered by an event named: post-updated.3.

#Listening for events from specific child components
Livewire allows you to listen for events directly on individual child components in your Blade template like so:

<div>
    <livewire:edit-post @saved="$refresh">
 
    <!-- ... -->
</div>
In the above scenario, if the edit-post child component dispatches a saved event, the parent's $refresh will be called and the parent will be refreshed.

Instead of passing $refresh, you can pass any method you normally would to something like wire:click. Here's an example of calling a close() method that might do something like close a modal dialog:

<livewire:edit-post @saved="close">
If the child dispatched parameters along with the request, for example $this->dispatch('saved', postId: 1), you can forward those values to the parent method using the following syntax:

<livewire:edit-post @saved="close($event.detail.postId)">
#Using JavaScript to interact with events
Livewire's event system becomes much more powerful when you interact with it from JavaScript inside your application. This unlocks the ability for any other JavaScript in your app to communicate with Livewire components on the page.

#Listening for events inside component scripts
You can easily listen for the post-created event inside your component's template from a <script> tag like so:

<script>
    this.$on('post-created', () => {
        //
    });
</script>
The above snippet would listen for the post-created from the component it's registered within. If the component is no longer on the page, the event listener will no longer be triggered.

Read more about using JavaScript inside your Livewire components →

#Dispatching events from component scripts
Additionally, you can dispatch events from within a component's <script> tag like so:

<script>
    this.$dispatch('post-created');
</script>
When the above script is run, the post-created event will be dispatched to the component it's defined within.

To dispatch the event only to the component where the script resides and not other components on the page (preventing the event from "bubbling" up), you can use dispatchSelf():

this.$dispatchSelf('post-created');
You can pass any additional parameters to the event by passing an object as a second argument to dispatch():

<script>
    this.$dispatch('post-created', { refreshPosts: true });
</script>
You can now access those event parameters from both your Livewire class and also other JavaScript event listeners.

Here's an example of receiving the refreshPosts parameter within a Livewire class:

use Livewire\Attributes\On;
 
// ...
 
#[On('post-created')]
public function handleNewPost($refreshPosts = false)
{
    //
}
You can also access the refreshPosts parameter from a JavaScript event listener from the event's detail property:

<script>
    this.$on('post-created', (event) => {
        let refreshPosts = event.detail.refreshPosts
 
        // ...
    });
</script>
Read more about using JavaScript inside your Livewire components →

#Listening for Livewire events from global JavaScript
Alternatively, you can listen for Livewire events globally using Livewire.on from any script in your application:

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('post-created', (event) => {
           //
       });
    });
</script>
The above snippet would listen for the post-created event dispatched from any component on the page.

If you wish to remove this event listener for any reason, you can do so using the returned cleanup function:

<script>
    document.addEventListener('livewire:init', () => {
        let cleanup = Livewire.on('post-created', (event) => {
            //
        });
 
        // Calling "cleanup()" will un-register the above event listener...
        cleanup();
    });
</script>
#Events in Alpine
Because Livewire events are plain browser events under the hood, you can use Alpine to listen for them or even dispatch them.

#Listening for Livewire events in Alpine
For example, we may easily listen for the post-created event using Alpine:

<div x-on:post-created="..."></div>
The above snippet would listen for the post-created event from any Livewire components that are children of the HTML element that the x-on directive is assigned to.

To listen for the event from any Livewire component on the page, you can add .window to the listener:

<div x-on:post-created.window="..."></div>
If you want to access additional data that was sent with the event, you can do so using $event.detail:

<div x-on:post-created="notify('New post: ' + $event.detail.title)"></div>
The Alpine documentation provides further information on listening for events.

#Dispatching Livewire events from Alpine
Any event dispatched from Alpine is capable of being intercepted by a Livewire component.

For example, we may easily dispatch the post-created event from Alpine:

<button x-on:click="$dispatch('post-created')">...</button>
Like Livewire's dispatch() method, you can pass additional data along with the event by passing the data as the second parameter to the method:

<button x-on:click="$dispatch('post-created', { title: 'Post Title' })">...</button>
To learn more about dispatching events using Alpine, consult the Alpine documentation.

You might not need events
If you are using events to call behavior on a parent from a child, you can instead call the action directly from the child using $parent in your Blade template. For example:

<button wire:click="$parent.showCreatePostForm()">Create Post</button>
Learn more about $parent.

#Dispatching directly to another component
If you want to use events for communicating directly between two components on the page, you can use the dispatch()->to() modifier.

Below is an example of the post.create component dispatching the post-created event directly to the dashboard component, skipping any other components listening for that specific event:

<?php // resources/views/components/post/⚡create.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public function save()
    {
        // ...
 
        $this->dispatch('post-created')->to(component: Dashboard::class);
    }
};
#Dispatching a component event to itself
Using the dispatch()->self() modifier, you can restrict an event to only being intercepted by the component it was triggered from:

<?php // resources/views/components/post/⚡create.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public function save()
    {
        // ...
 
        $this->dispatch('post-created')->to(self: true);
    }
};
#Dispatching events from Blade templates
You can dispatch events directly from your Blade templates using the $dispatch JavaScript function. This is useful when you want to trigger an event from a user interaction, such as a button click:

<button wire:click="$dispatch('show-post-modal', { id: {{ $post->id }} })">
    EditPost
</button>
In this example, when the button is clicked, the show-post-modal event will be dispatched with the specified data.

If you want to dispatch an event directly to another component you can use the $dispatchTo() JavaScript function:

<button wire:click="$dispatchTo('posts', 'show-post-modal', { id: {{ $post->id }} })">
    EditPost
</button>
In this example, when the button is clicked, the show-post-modal event will be dispatched directly to the Posts component.

#Testing dispatched events
To test events dispatched by your component, use the assertDispatched() method in your Livewire test. This method checks that a specific event has been dispatched during the component's lifecycle:

<?php
 
namespace Tests\Feature;
 
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\CreatePost;
use Livewire\Livewire;
 
class CreatePostTest extends TestCase
{
    use RefreshDatabase;
 
    public function test_it_dispatches_post_created_event()
    {
        Livewire::test(CreatePost::class)
            ->call('save')
            ->assertDispatched('post-created');
    }
}
In this example, the test ensures that the post-created event is dispatched with the specified data when the save() method is called on the post.create component.

#Testing Event Listeners
To test event listeners, you can dispatch events from the test environment and assert that the expected actions are performed in response to the event:

<?php
 
namespace Tests\Feature;
 
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\Dashboard;
use Livewire\Livewire;
 
class DashboardTest extends TestCase
{
    use RefreshDatabase;
 
    public function test_it_updates_post_count_when_a_post_is_created()
    {
        Livewire::test(Dashboard::class)
            ->assertSee('Posts created: 0')
            ->dispatch('post-created')
            ->assertSee('Posts created: 1');
    }
}
In this example, the test dispatches the post-created event, then checks that the dashboard component properly handles the event and displays the updated count.

#Real-time events using Laravel Echo
Livewire pairs nicely with Laravel Echo to provide real-time functionality on your web-pages using WebSockets.

Installing Laravel Echo is a prerequisite
This feature assumes you have installed Laravel Echo and the window.Echo object is globally available in your application. For more information on installing echo, check out the Laravel Echo documentation.

#Listening for Echo events
Imagine you have an event in your Laravel application named OrderShipped:

<?php
 
namespace App\Events;
 
use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
 
class OrderShipped implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
 
    public Order $order;
 
    public function broadcastOn()
    {
        return new Channel('orders');
    }
}
You might dispatch this event from another part of your application like so:

use App\Events\OrderShipped;
 
OrderShipped::dispatch();
If you were to listen for this event in JavaScript using only Laravel Echo, it would look something like this:

Echo.channel('orders')
    .listen('OrderShipped', e => {
        console.log(e.order)
    })
Assuming you have Laravel Echo installed and configured, you can listen for this event from inside a Livewire component.

Below is an example of an order-tracker component that is listening for the OrderShipped event in order to show users a visual indication of a new order:

<?php // resources/views/components/⚡order-tracker.blade.php
 
use Livewire\Attributes\On; 
use Livewire\Component;
 
new class extends Component {
    public $showNewOrderNotification = false;
 
    #[On('echo:orders,OrderShipped')]
    public function notifyNewOrder()
    {
        $this->showNewOrderNotification = true;
    }
 
    // ...
};
If you have Echo channels with variables embedded in them (such as an Order ID), you can define listeners via the getListeners() method instead of the #[On] attribute:

<?php // resources/views/components/⚡order-tracker.blade.php
 
use Livewire\Attributes\On; 
use Livewire\Component;
use App\Models\Order;
 
new class extends Component {
    public Order $order;
 
    public $showOrderShippedNotification = false;
 
    public function getListeners()
    {
        return [
            "echo:orders.{$this->order->id},OrderShipped" => 'notifyShipped',
        ];
    }
 
    public function notifyShipped()
    {
        $this->showOrderShippedNotification = true;
    }
 
    // ...
};
Or, if you prefer, you can use the dynamic event name syntax:

#[On('echo:orders.{order.id},OrderShipped')]
public function notifyNewOrder()
{
    $this->showNewOrderNotification = true;
}
If you need to access the event payload, you can do so via the passed in $event parameter:

#[On('echo:orders.{order.id},OrderShipped')]
public function notifyNewOrder($event)
{
    $order = Order::find($event['orderId']);
 
    //
}
#Private & presence channels
You may also listen to events broadcast to private and presence channels:

Before proceeding, ensure you have defined Authentication Callbacks for your broadcast channels.

<?php // resources/views/components/⚡order-tracker.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $showNewOrderNotification = false;
 
    public function getListeners()
    {
        return [
            // Public Channel
            "echo:orders,OrderShipped" => 'notifyNewOrder',
 
            // Private Channel
            "echo-private:orders,OrderShipped" => 'notifyNewOrder',
 
            // Presence Channel
            "echo-presence:orders,OrderShipped" => 'notifyNewOrder',
            "echo-presence:orders,here" => 'notifyNewOrder',
            "echo-presence:orders,joining" => 'notifyNewOrder',
            "echo-presence:orders,leaving" => 'notifyNewOrder',
        ];
    }
 
    public function notifyNewOrder()
    {
        $this->showNewOrderNotification = true;
    }
};

Lifecycle Hooks
Are you a visual learner?
Master Livewire with our in-depth screencasts
Watch now
Livewire provides a variety of lifecycle hooks that allow you to execute code at specific points during a component's lifecycle. These hooks enable you to perform actions before or after particular events, such as initializing the component, updating properties, or rendering the template.

Here's a list of all the available component lifecycle hooks:

Hook Method	Description
mount()	Called when a component is created
hydrate()	Called when a component is re-hydrated at the beginning of a subsequent request
boot()	Called at the beginning of every request. Both initial, and subsequent
updating()	Called before updating a component property
updated()	Called after updating a property
rendering()	Called before render() is called
rendered()	Called after render() is called
dehydrate()	Called at the end of every component request
exception($e, $stopPropagation)	Called when an exception is thrown
#Mount
In a standard PHP class, a constructor (__construct()) takes in outside parameters and initializes the object's state. However, in Livewire, you use the mount() method for accepting parameters and initializing the state of your component.

Livewire components don't use __construct() because Livewire components are re-constructed on subsequent network requests, and we only want to initialize the component once when it is first created.

Here's an example of using the mount() method to initialize the name and email properties of a profile.edit component:

<?php // resources/views/components/profile/⚡edit.blade.php
 
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
 
new class extends Component {
    public $name;
 
    public $email;
 
    public function mount()
    {
        $this->name = Auth::user()->name;
 
        $this->email = Auth::user()->email;
    }
 
    // ...
};
As mentioned earlier, the mount() method receives data passed into the component as method parameters:

<?php // resources/views/components/post/⚡edit.blade.php
 
use Livewire\Component;
use App\Models\Post;
 
new class extends Component {
    public $title;
 
    public $content;
 
    public function mount(Post $post)
    {
        $this->title = $post->title;
 
        $this->content = $post->content;
    }
 
    // ...
};
You can use dependency injection with all hook methods
Livewire allows you to resolve dependencies out of Laravel's service container by type-hinting method parameters on lifecycle hooks.

The mount() method is a crucial part of using Livewire. The following documentation provides further examples of using the mount() method to accomplish common tasks:

Initializing properties
Receiving data from parent components
Accessing route parameters
#Boot
As helpful as mount() is, it only runs once per component lifecycle, and you may want to run logic at the beginning of every single request to the server for a given component.

For these cases, Livewire provides a boot() method where you can write component setup code that you intend to run every single time the component class is booted: both on initialization and on subsequent requests.

The boot() method can be useful for things like initializing protected properties, which are not persisted between requests. Below is an example of initializing a protected property as an Eloquent model:

<?php // resources/views/components/post/⚡show.blade.php
 
use Livewire\Attributes\Locked;
use Livewire\Component;
use App\Models\Post;
 
new class extends Component {
    #[Locked]
    public $postId = 1;
 
    protected Post $post;
 
    public function boot() 
    {
        $this->post = Post::find($this->postId);
    }
 
    // ...
};
You can use this technique to have complete control over initializing a component property in your Livewire component.

Most of the time, you can use a computed property instead
The technique used above is powerful; however, it's often better to use Livewire's computed properties to solve this use case.

Always lock sensitive public properties
As you can see above, we are using the #[Locked] attribute on the $postId property. In a scenario like the above, where you want to ensure the $postId property isn't tampered with by users on the client-side, it's important to authorize the property's value before using it or add #[Locked] to the property ensure it is never changed.

For more information, check out the documentation on the Locked attribute.

#Update
Client-side users can update public properties in many different ways, most commonly by modifying an input with wire:model on it.

Livewire provides convenient hooks to intercept the updating of a public property so that you can validate or authorize a value before it's set, or ensure a property is set in a given format.

Below is an example of using updating to prevent the modification of the $postId property.

It's worth noting that for this particular example, in an actual application, you should use the #[Locked] attribute instead, like in the above example.

<?php // resources/views/components/post/⚡show.blade.php
 
use Exception;
use Livewire\Component;
 
new class extends Component {
    public $postId = 1;
 
    public function updating($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property
 
        if ($property === 'postId') {
            throw new Exception;
        }
    }
 
    // ...
};
The above updating() method runs before the property is updated, allowing you to catch invalid input and prevent the property from updating. Below is an example of using updated() to ensure a property's value stays consistent:

<?php // resources/views/components/user/⚡create.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $username = '';
 
    public $email = '';
 
    public function updated($property)
    {
        // $property: The name of the current property that was updated
 
        if ($property === 'username') {
            $this->username = strtolower($this->username);
        }
    }
 
    // ...
};
Now, anytime the $username property is updated client-side, we will ensure that the value will always be lowercase.

Because you are often targeting a specific property when using update hooks, Livewire allows you to specify the property name directly as part of the method name. Here's the same example from above but rewritten utilizing this technique:

<?php // resources/views/components/user/⚡create.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $username = '';
 
    public $email = '';
 
    public function updatedUsername()
    {
        $this->username = strtolower($this->username);
    }
 
    // ...
};
Of course, you can also apply this technique to the updating hook.

#Arrays
Array properties have an additional $key argument passed to these functions to specify the changing element.

Note that when the array itself is updated instead of a specific key, the $key argument is null.

<?php // resources/views/components/preferences/⚡edit.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $preferences = [];
 
    public function updatedPreferences($value, $key)
    {
        // $value = 'dark'
        // $key   = 'theme'
    }
 
    // ...
};
#Hydrate & Dehydrate
Hydrate and dehydrate are lesser-known and lesser-utilized hooks. However, there are specific scenarios where they can be powerful.

The terms "dehydrate" and "hydrate" refer to a Livewire component being serialized to JSON for the client-side and then unserialized back into a PHP object on the subsequent request.

We often use the terms "hydrate" and "dehydrate" to refer to this process throughout Livewire's codebase and the documentation. If you'd like more clarity on these terms, you can learn more by consulting our hydration documentation.

Let's look at an example that uses both mount() , hydrate(), and dehydrate() all together to support using a custom data transfer object (DTO) instead of an Eloquent model to store the post data in the component:

<?php // resources/views/components/post/⚡show.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public $post;
 
    public function mount($title, $content)
    {
        // Runs at the beginning of the first initial request...
 
        $this->post = new PostDto([
            'title' => $title,
            'content' => $content,
        ]);
    }
 
    public function hydrate()
    {
        // Runs at the beginning of every "subsequent" request...
        // This doesn't run on the initial request ("mount" does)...
 
        $this->post = new PostDto($this->post);
    }
 
    public function dehydrate()
    {
        // Runs at the end of every single request...
 
        $this->post = $this->post->toArray();
    }
 
    // ...
};
Now, from actions and other places inside your component, you can access the PostDto object instead of the primitive data.

The above example mainly demonstrates the abilities and nature of the hydrate() and dehydrate() hooks. However, it is recommended that you use Wireables or Synthesizers to accomplish this instead.

#Render
If you want to hook into the process of rendering a component's Blade view, you can do so using the rendering() and rendered() hooks:

<?php // resources/views/components/post/⚡index.blade.php
 
use Livewire\Component;
use App\Models\Post;
 
new class extends Component {
    public function render()
    {
        return $this->view([
            'post' => Post::all(),
        ]);
    }
 
    public function rendering($view, $data)
    {
        // Runs BEFORE the provided view is rendered...
        //
        // $view: The view about to be rendered
        // $data: The data provided to the view
    }
 
    public function rendered($view, $html)
    {
        // Runs AFTER the provided view is rendered...
        //
        // $view: The rendered view
        // $html: The final, rendered HTML
    }
 
    // ...
};
#Exception
Sometimes it can be helpful to intercept and catch errors, eg: to customize the error message or ignore specific type of exceptions. The exception() hook allows you to do just that: you can perform check on the $error, and use the $stopPropagation parameter to catch the issue. This also unlocks powerful patterns when you want to stop further execution of code (return early), this is how internal methods like validate() works.

<?php // resources/views/components/post/⚡show.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public function mount() 
    {
        $this->post = Post::find($this->postId);
    }
 
    public function exception($e, $stopPropagation) {
        if ($e instanceof NotFoundException) {
            $this->notify('Post is not found');
            $stopPropagation();
        }
    }
 
    // ...
};
#Using hooks inside a trait
Traits are a helpful way to reuse code across components or extract code from a single component into a dedicated file.

To avoid multiple traits conflicting with each other when declaring lifecycle hook methods, Livewire supports prefixing hook methods with the camelCased name of the current trait declaring them.

This way, you can have multiple traits using the same lifecycle hooks and avoid conflicting method definitions.

Below is an example of a component referencing a trait called HasPostForm:

<?php // resources/views/components/post/⚡create.blade.php
 
use Livewire\Component;
 
new class extends Component {
    use HasPostForm;
 
    // ...
};
Now here's the actual HasPostForm trait containing all the available prefixed hooks:

trait HasPostForm
{
    public $title = '';
 
    public $content = '';
 
    public function mountHasPostForm()
    {
        // ...
    }
 
    public function hydrateHasPostForm()
    {
        // ...
    }
 
    public function bootHasPostForm()
    {
        // ...
    }
 
    public function updatingHasPostForm()
    {
        // ...
    }
 
    public function updatedHasPostForm()
    {
        // ...
    }
 
    public function renderingHasPostForm()
    {
        // ...
    }
 
    public function renderedHasPostForm()
    {
        // ...
    }
 
    public function dehydrateHasPostForm()
    {
        // ...
    }
 
    // ...
}
#Using hooks inside a form object
Form objects in Livewire support property update hooks. These hooks work similarly to component update hooks, letting you perform actions when properties in the form object change.

Below is an example of a component using a PostForm form object:

<?php // resources/views/components/post/⚡create.blade.php
 
use Livewire\Component;
 
new class extends Component {
    public PostForm $form;
 
    // ...
};
Here's the PostForm form object containing all the available hooks:

namespace App\Livewire\Forms;
 
use Livewire\Attributes\Validate;
use Livewire\Form;
 
class PostForm extends Form
{
    public $title = '';
 
    public $tags = [];
 
    public function updating($property, $value)
    {
        // ...
    }
 
    public function updated($property, $value)
    {
        // ...
    }
 
    public function updatingTitle($value)
    {
        // ...
    }
 
    public function updatedTitle($value)
    {
        // ...
    }
 
    public function updatingTags($value, $key)
    {
        // ...
    }
 
    public function updatedTags($value, $key)
    {
        // ...
    }
 
    // ...
}