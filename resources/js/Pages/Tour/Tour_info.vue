<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import tableau_niv_coul from "@/Components/NiveauCouleur.vue";
import { useForm } from "@inertiajs/vue3";

// const props = defineProps(["date_dispo"]);
const props = defineProps(["tour_perso", "tour_niveau", "gold"]);
console.log(props.tour_perso, props.tour_niveau);

let form = useForm({
    tour_up: props.tour_niveau?.id,
    tour_actuel: props.tour_perso.id,
    gold_user: props.gold,
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

        <main class="pt-12 w-5/12 grid justify-center m-auto mb-5" id="update">
            <section class="flex justify-between gap-6">
                <figure class="">
                    <img
                        class="h-100"
                        :src="`/storage${tour_perso.tour.img_path}`"
                        alt=""
                    />

                    <figcaption>
                        <p class="text-xl font pb-2">
                            <span class="font-bold">Niveau</span>
                            <span
                                :class="tableau_niv_coul[tour_perso.niveau]"
                                id="niveau"
                                >{{ tour_perso.niveau }}</span
                            >
                        </p>
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
                    </figcaption>
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

                    <figcaption>
                        <p class="text-xl font pb-2">
                            <span class="font-bold">Niveau</span>
                            <span
                                :class="tableau_niv_coul[tour_niveau.niveau]"
                                id="niveau"
                                >{{ tour_niveau.niveau }}</span
                            >
                        </p>
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
                    </figcaption>
                </figure>
            </section>
            <section v-if="props.tour_niveau" class="grid text-center">
                <h2>Objet requis</h2>
                <img class="rounded-xl" src="/storage/item/gold.png" alt="" />
                <p>
                    {{ gold }} /
                    {{ tour_niveau.gold_requis }}
                </p>

                <form
                    class="m-auto"
                    @submit.prevent="
                        form.post(
                            route('tour_info.update', {
                                tour_up: form.tour_up,
                                tour_actuel: form.tour_actuel,
                                gold_user: form.gold_user,
                            })
                        )
                    "
                    enctype="multipart/form-data"
                >
                    <button
                        type="submit"
                        class="py-3 mt-4 px-8 text-center text-white bg-black rounded-xl"
                    >
                        Améliorer
                    </button>
                </form>
            </section>
        </main>
    </AppLayout>
</template>
