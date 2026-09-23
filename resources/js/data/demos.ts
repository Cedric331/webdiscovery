/**
 * Registre des démos commerciales affichées dans le menu « Démos ».
 *
 * Pour ajouter une démo (restaurant, artisan, immobilier, thérapeute…) :
 * ajouter une entrée ici. Le menu desktop, le menu mobile et le footer des
 * pages publiques se mettent à jour automatiquement.
 *
 * Le pendant côté serveur (contenu, FAQ, données structurées) se trouve dans
 * App\Http\Controllers\DemoController.
 */
export interface DemoLink {
    /** Libellé affiché dans le menu */
    label: string;
    /** Courte description affichée sous le libellé (dropdown desktop) */
    description: string;
    /** URL interne de la landing page */
    href: string;
    /** Emoji utilisé comme icône, comme sur le reste du site */
    icon: string;
}

export const demoLinks: DemoLink[] = [
    {
        label: 'Coach Fitness',
        description: 'Site vitrine pour coach sportif & personal trainer',
        href: '/site-coach-sportif',
        icon: '💪',
    },
];
