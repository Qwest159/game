<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import tableau_niv_coul from "@/Components/CouleurNiveau.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, defineProps, defineEmits } from "@vue/runtime-core";

// const emit = defineEmits(["mont"]);

import Combat from "@/Pages/Outside/Combat.vue";

const props = defineProps([
    "hero_user",
    "monstre",
    "carac_monst",
    "outside_map",
    "attaques_user",
]);
let attribut = ["feu", "eau", "plante", "électrique"];

let tableau_mystere = ref([]);
let niveau_bataille = ref(0);
let montrer_bataille = ref(false);

let tableau_monstre = [];
let tableau_monstre_carte = ref([]);

for (let index = 0; index < 9; index++) {
    tableau_mystere.value[index] = {
        img_mystere: "outside/mystere.png",
    };
    tableau_monstre_carte.value[index] = {
        monstre_choisi: {},
    };

    for (let nbr_monstre = 0; nbr_monstre < 3; nbr_monstre++) {
        tableau_monstre_carte.value[index].monstre_choisi[nbr_monstre] = {
            ...props.monstre[Math.floor(Math.random() * props.monstre.length)],
            ...props.carac_monst[index],
            ...{ type: attribut[Math.floor(Math.random() * attribut.length)] },
        };
        // (tableau_mystere.value[index].carac_monst_choisi[nbr_monstre] =
        //     props.carac_monst[index + 1]) +
        //     type[Math.floor(Math.random() * type.length)];
    }
}

// console.log(type[Math.floor(Math.random() * type.length)]);

// for (let index = 1; index < 10; index++) {
//     tableau_mystere.value[index] = ["img_mystere"];

//     tableau_mystere.value[index]["img_mystere"] = ;
//     for (let nbr_monstre = 0; nbr_monstre < 2; nbr_monstre++) {
//         tableau_mystere.value[index]["monstre"] =
//             monstre[Math.floor(Math.random() * monstre.length)];
//     }
// }

let form = useForm({});
console.log(tableau_mystere.value);

// console.log(tour_niveau[hero_user.niveau]);

function combat_user(index) {
    niveau_bataille.value = [props.outside_map[index], index];
    tableau_monstre = tableau_monstre_carte.value[index];

    montrer_bataille.value = true;
}
</script>

<template>
    <AppLayout title="Exterieur">
        <main class="h-screen pt-16 bg-black" id="outside">
            <section class="">
                <figure class="">
                    <img
                        class="w-full rounded-t-xl"
                        :src="`/storage${hero_user.portrait}`"
                        alt=""
                    />

                    <table class="rounded-b-xl">
                        <tbody>
                            <tr class="non text-xl font m-auto pb-2">
                                <td class="">{{ hero_user.role }}</td>
                            </tr>
                            <tr class="non text-xl font pb-2 m-auto">
                                <td class="font-bold text-center">Niveau</td>
                                <td
                                    :class="tableau_niv_coul[hero_user.niveau]"
                                    id="niveau"
                                >
                                    {{ hero_user.niveau }}
                                </td>
                            </tr>

                            <tr>
                                <td class="self-center">HP</td>
                                <td class="text-center">
                                    <p class="border-b-2 border-black">
                                        {{ hero_user.hp_restant }}
                                    </p>
                                    <p>{{ hero_user.caract_hero.hp }}</p>
                                </td>
                            </tr>
                            <tr class="">
                                <td>ATT</td>
                                <td class="text-center">
                                    {{ hero_user.caract_hero.att }}
                                </td>
                            </tr>
                            <tr>
                                <td>DEF</td>
                                <td class="text-center">
                                    {{ hero_user.caract_hero.def }}
                                </td>
                            </tr>
                            <tr>
                                <td class="self-center">EXP</td>
                                <td class="text-center">
                                    <p class="border-b-2 border-black">
                                        {{ hero_user.exp_restant }}
                                    </p>

                                    <p class="">
                                        {{ hero_user.caract_hero.exp_requis }}
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </figure>
            </section>

            <section class="grid grid-cols-3">
                <figure
                    v-for="(carte, index) in tableau_mystere"
                    class="carte cursor-pointer"
                    @click="combat_user(index)"
                >
                    <img
                        class=""
                        :src="`storage/${carte.img_mystere}`"
                        alt=""
                    />
                    <p class="text-white">Niveau {{ index + 1 }}</p>
                </figure>
            </section>
        </main>
        <Combat
            v-if="montrer_bataille"
            class="element"
            :attaques_user="props.attaques_user"
            :hero_user="props.hero_user"
            :tableau_monstre_carte="tableau_monstre"
            :niveau_bataille="niveau_bataille"
            @info_hp_et_xp="hp_hero = $event"
            @montrer_bataille="montrer_bataille = $event"
            @gagner_combat="
                tableau_mystere[$event[1].index].img_mystere = $event[1].img
            "
        />
    </AppLayout>
</template>
