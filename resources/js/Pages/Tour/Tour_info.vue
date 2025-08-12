<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import tableau_niv_coul from "@/Components/CouleurNiveau.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

let click_button = ref(true);

// const props = defineProps(["date_dispo"]);
const props = defineProps([
    "tours_user_id",
    "tour_perso",
    "tour_niveau",
    "gold",
]);
console.log();

function succes() {
    click_button.value = false;
    form.post(
        route("tour_info.update", {
            id_tour_user: form.id_tour_user,
            id_tour_up: props.tour_niveau.id,
            gold_requis: props.tour_niveau.gold_requis,
        }),
        {
            onSuccess: () => {
                click_button.value = true;

                console.log(click_button.value);

                // Réinitialise après 5 secondes l'affichage du bouton
                // setTimeout(() => {
                //     affichage_resultat.value = false;
                // }, 5000);
            },
            onError: () => {
                click_button.value = true;
            },
        }
    );
}

let form = useForm({
    id_tour_user: props.tours_user_id,
});

// console.log(tour_niveau[tour_perso.niveau]);
</script>

<template>
    <AppLayout title="Modification tour">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Modification tour
            </h2>
        </template>

        <main class="pt-9 w-5/12 grid justify-center m-auto mb-5" id="update">
            <section class="flex justify-between gap-6">
                <figure class="">
                    <img
                        class="h-100"
                        :src="`/storage${tour_perso.tour.img_path}`"
                        alt=""
                    />

                    <table>
                        <tbody>
                            <tr class="non text-xl font-bold pb-2 m-auto">
                                <td class="font-bold text-center">Niveau</td>
                                <td
                                    :class="tableau_niv_coul[tour_perso.niveau]"
                                    id="niveau"
                                >
                                    {{ tour_perso.niveau }}
                                </td>
                            </tr>

                            <tr>
                                <td>HP</td>
                                <td>{{ tour_perso.hp }}</td>
                            </tr>
                            <tr>
                                <td>ATT</td>
                                <td>{{ tour_perso.att }}</td>
                            </tr>
                            <tr>
                                <td>DEF</td>
                                <td>{{ tour_perso.def }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p
                        class="text-red-600 font-bold text-center text-2xl"
                        v-if="!props.tour_niveau"
                    >
                        Max
                    </p>
                </figure>

                <!-- -----------UP SUIVANT ----------- -->
                <figure class="" v-if="props.tour_niveau">
                    <img
                        class="h-100"
                        :src="`/storage${tour_niveau.tour.img_path}`"
                        alt=""
                    />

                    <table>
                        <tbody>
                            <tr class="non text-xl font-bold pb-2 m-auto">
                                <td class="font-bold text-center">Niveau</td>
                                <td
                                    :class="
                                        tableau_niv_coul[tour_niveau.niveau]
                                    "
                                    id="niveau"
                                >
                                    {{ tour_niveau.niveau }}
                                </td>
                            </tr>

                            <tr>
                                <td>HP</td>
                                <td>{{ tour_niveau.hp }}</td>
                            </tr>
                            <tr>
                                <td>ATT</td>
                                <td>{{ tour_niveau.att }}</td>
                            </tr>
                            <tr>
                                <td>DEF</td>
                                <td>{{ tour_niveau.def }}</td>
                            </tr>
                        </tbody>
                    </table>
                </figure>
            </section>
            <section v-if="props.tour_niveau" class="grid text-center">
                <h2>Objet requis</h2>
                <img
                    class="rounded-xl w-16"
                    src="/storage/item/gold.png"
                    alt=""
                />
                <p>
                    {{ gold }} /
                    {{ tour_niveau.gold_requis }}
                </p>

                <form
                    class="m-auto"
                    @submit.prevent="succes()"
                    enctype="multipart/form-data"
                >
                    <button
                        v-show="gold > tour_niveau.gold_requis && click_button"
                        type="submit"
                        class="py-3 mt-4 px-8 text-center text-white bg-black rounded-xl z-10"
                    >
                        Améliorer
                    </button>
                    <button
                        v-show="gold < tour_niveau.gold_requis || !click_button"
                        disabled
                        class="py-3 mt-4 px-8 text-center text-white bg-gray-400 rounded-xl"
                    >
                        Améliorer
                    </button>
                </form>
            </section>
        </main>
    </AppLayout>
</template>
