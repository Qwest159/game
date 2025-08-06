<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import tableau_niv_coul from "@/Components/NiveauCouleur.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

// const props = defineProps(["date_dispo"]);
const props = defineProps(["hero_user"]);

let form = useForm({});

// console.log(tour_niveau[hero_user.niveau]);
</script>

<template>
    <AppLayout title="Exterieur">
        <main class="h-screen bg-black" id="">
            <section class="flex justify-between gap-6 top-16 left-0 absolute">
                <figure class="">
                    <img
                        class="w-full rounded-t-xl"
                        :src="`/storage${hero_user.portrait}`"
                        alt=""
                    />

                    <figcaption class="rounded-b-xl">
                        <h4 class="text-center font-bold mb-2">
                            {{ hero_user.role }}
                        </h4>
                        <p class="text-xl font pb-2 text-center">
                            <span class="font-bold">Niveau</span>
                            <span
                                :class="tableau_niv_coul[hero_user.hero.niveau]"
                                id="niveau"
                                >{{ hero_user.hero.niveau }}</span
                            >
                        </p>
                        <tr>
                            <td>HP</td>
                            <td>{{ hero_user.hero.hp }}</td>
                        </tr>
                        <tr>
                            <td>ATT</td>
                            <td>{{ hero_user.hero.att }}</td>
                        </tr>
                        <tr>
                            <td>DEF</td>
                            <td>{{ hero_user.hero.def }}</td>
                        </tr>
                        <tr>
                            <td>EXP</td>
                            <td>{{ hero_user.hero.exp }}</td>
                        </tr>
                    </figcaption>
                </figure>
            </section>

            <section class="bg-white w-6/12 h-3/6 m-auto"></section>
        </main>
    </AppLayout>
</template>
