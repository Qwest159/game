<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

import { useForm, usePage } from "@inertiajs/vue3";
import { defineProps, ref, onMounted } from "@vue/runtime-core";

const props = defineProps(["flash", "tours", "caract_hero", "perso_hero"]);

// définir les données

let form = useForm({
    tour: [],
    rôle: "",
    portrait: "",
});

let erreurs = ref("");
let bouton_envoyer = ref(true);

function succes() {
    bouton_envoyer.value = false;
    form.post(route("creation_compte"), {
        onSuccess: () => {},

        onError: () => {
            erreurs.value = {
                error: usePage().props.errors,
            };
            bouton_envoyer.value = true;
        },
    });
}

let tableaux_tour_cible = ref([]);

function tableaux_tour(id) {
    let tour = tableaux_tour_cible.value;
    let index = tour.indexOf(id);
    if (tour.length < 3 || index != -1) {
        index != -1 ? tour.splice(index, 1) : tour.push(id);
    }
    form.tour = tableaux_tour_cible;
}
</script>

<template>
    <main class="w-4/5 m-auto" id="newaccount">
        <form
            @submit.prevent="succes()"
            enctype="multipart/form-data"
            class="space-y-6 p-5 flex flex-col border-2 rounded-xl"
        >
            <!-- Tour -->
            <h1>Choisissez vos 3 tours</h1>
            <div v-if="form.errors.tour" class="text-sm text-red-500 mt-1">
                {{ form.errors.tour }}
            </div>
            <section
                class="flex flex-wrap justify-evenly gap-4 bg-blue-400 my-4 py-4"
            >
                <figure
                    v-for="(tour, index) in tours"
                    class="border-4 border-solid border-black text-center cursor-pointer"
                    :class="
                        form.tour.some((id_cherche) => id_cherche === tour.id)
                            ? 'border-red-500'
                            : ''
                    "
                    @click="tableaux_tour(tour.id)"
                >
                    <img
                        class="m-auto"
                        :src="`storage/${tour.tour.img_path}`"
                        alt=""
                    />

                    <table class="">
                        <tbody>
                            <tr class="text-xl font-bold pb-2">
                                <td class="">Niveau</td>
                                <td>
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
            </section>

            <h1>Choisissez votre rôle</h1>
            <div v-if="form.errors.rôle" class="text-sm text-red-500 mt-1">
                {{ form.errors.rôle }}
            </div>
            <section
                class="flex flex-wrap justify-evenly gap-4 bg-yellow-300 my-4 py-4"
            >
                <figure
                    v-for="caract_role in props.caract_hero"
                    class="border-4 border-solid border-black text-center cursor-pointer"
                    @click="form.rôle = caract_role.id"
                    :class="
                        form.rôle === caract_role.id ? 'border-red-500' : ''
                    "
                >
                    <table class="">
                        <tbody>
                            <tr class="skill text-xl font m-auto pb-2">
                                <td class="">
                                    <h3>{{ caract_role.role.role }}</h3>
                                </td>
                            </tr>

                            <tr>
                                <td class="self-center">HP</td>
                                <td class="text-center">
                                    <p>{{ caract_role.hp }}</p>
                                </td>
                            </tr>
                            <tr class="">
                                <td>ATT</td>
                                <td class="text-center">
                                    {{ caract_role.att }}
                                </td>
                            </tr>
                            <tr>
                                <td>DEF</td>
                                <td class="text-center">
                                    {{ caract_role.def }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </figure>
            </section>

            <!-- ---- portrait ------ -->
            <h1>Choisissez votre portrait</h1>
            <div v-if="form.errors.portrait" class="text-sm text-red-500 mt-1">
                {{ form.errors.portrait }}
            </div>
            <section
                class="flex flex-wrap justify-evenly gap-4 bg-green-400 my-4 py-4"
            >
                <figure
                    v-for="portrait in props.perso_hero"
                    class="border-4 border-solid border-black text-center cursor-pointer"
                    @click="form.portrait = portrait.id"
                    :class="
                        form.portrait === portrait.id ? 'border-red-500' : ''
                    "
                >
                    <img :src="`storage${portrait.img_path}`" alt="" />
                    <img :src="`storage${portrait.portrait}`" alt="" />
                </figure>
            </section>

            <!-- ---- role ------- -->

            <div
                class="py-5 m-auto flex flex-col w-52 bg-black text-white cursor-pointer"
            >
                <button
                    v-show="bouton_envoyer"
                    type="submit"
                    class="rounded-none font-bold"
                >
                    Envoyer
                </button>
                <button
                    disabled
                    v-show="!bouton_envoyer"
                    class="rounded-none font-bold text-center z-10"
                >
                    Veuillez patienter
                </button>
            </div>
        </form>
    </main>
</template>
