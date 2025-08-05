<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import tableau_niv_coul from "@/Components/NiveauCouleur.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
const props = defineProps(["tours", "tours_id_user"]);
// const form = useForm(props);
</script>

<template>
    <AppLayout title="Dashboard">
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
                    :src="`storage ${tour.tour.img_path}`"
                    alt=""
                    @click="
                        () =>
                            $inertia.get(
                                route('tour_info', props.tours_id_user[index])
                            )
                    "
                />

                <figcaption class="">
                    <p class="text-xl font pb-2">
                        <span class="font-bold">Niveau</span>
                        <span
                            id="niveau"
                            :class="tableau_niv_coul[tour.niveau]"
                            >{{ tour.niveau }}</span
                        >
                    </p>
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
                </figcaption>
            </figure>

            <figure class="porte">
                <img
                    id="porte_fermer"
                    src="storage/ville/porte_fermer.png"
                    @click="() => $inertia.get(route('tour_info'))"
                    alt=""
                />
                <img
                    id="porte_ouverte"
                    src="storage/ville/porte_ouverte.png"
                    alt=""
                    @click="() => $inertia.get(route('tour_info'))"
                />
            </figure>
            <figure class="chateau">
                <img
                    id="chateau_img"
                    src="storage/ville/chateau.png"
                    alt=""
                    @click="() => $inertia.get(route('tour_info'))"
                />
                <figcaption>
                    <p class="">salut</p>
                    <p class="">salut</p>
                </figcaption>
            </figure>
        </main>
    </AppLayout>
</template>
