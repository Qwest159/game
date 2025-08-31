<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import tableau_niv_coul from "@/Components/CouleurNiveau.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
const props = defineProps(["tours", "tours_id_user"]);
// const form = useForm(props);
</script>

<template>
    <AppLayout title="accueil">
        <main id="accueil">
            <figure>
                <img
                    class="h-lvh w-lvw"
                    src="storage/ville/ville1.jpg"
                    alt=""
                />
            </figure>

            <figure v-for="(tour, index) in tours" :class="`fig${index + 1}`">
                <img
                    :src="`storage${tour.tour.img_path}`"
                    alt=""
                    @click="
                        () =>
                            $inertia.get(
                                route('tour_info', props.tours_id_user[index])
                            )
                    "
                />

                <table class="rounded-b-xl text-lg">
                    <tbody>
                        <tr class="skill text-xl font-bold pb-2 m-auto">
                            <td class="font-bold text-center">Niveau</td>
                            <td
                                :class="tableau_niv_coul[tour.niveau]"
                                id="niveau"
                            >
                                {{ tour.niveau }}
                            </td>
                        </tr>

                        <tr>
                            <td>HP</td>
                            <td>{{ tour.hp }}</td>
                        </tr>
                        <tr>
                            <td>ATT</td>
                            <td>{{ tour.att }}</td>
                        </tr>
                        <tr>
                            <td>DEF</td>
                            <td>{{ tour.def }}</td>
                        </tr>
                    </tbody>
                </table>
            </figure>

            <figure class="porte">
                <img
                    id="porte_fermer"
                    src="storage/ville/porte_fermer.png"
                    @click="() => $inertia.get(route('outside'))"
                    alt=""
                />
                <img
                    id="porte_ouverte"
                    src="storage/ville/porte_ouverte.png"
                    alt=""
                    @click="() => $inertia.get(route('outside'))"
                />
            </figure>
            <figure class="chateau">
                <img
                    id="chateau_img"
                    src="storage/ville/chateau.png"
                    alt=""
                    @click="() => $inertia.get(route('chateau'))"
                />
            </figure>
        </main>
    </AppLayout>
</template>
