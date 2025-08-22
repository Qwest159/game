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

let difficulte_nbr_monstre = [1, 1, 1, 2, 2, 2, 3, 3, 4];
console.log(difficulte_nbr_monstre);

let tableau_mystere = ref([]);
let niveau_bataille = ref(0);
let carte_cible = ref();
let tableau_monstre_carte = ref([]);
let gain = ref({ or: 0, exp: 0 });
let tableau_monstre = [];

for (let index = 0; index < 9; index++) {
    tableau_mystere.value[index] = {
        img_mystere: "outside/mystere.png",
        montrer_bataille: false,
    };
    tableau_monstre_carte.value[index] = {
        monstre_choisi: {},
    };

    for (
        let nbr_monstre = 0;
        nbr_monstre < difficulte_nbr_monstre[index];
        nbr_monstre++
    ) {
        tableau_monstre_carte.value[index].monstre_choisi[nbr_monstre] = {
            ...props.monstre[Math.floor(Math.random() * props.monstre.length)],
            ...props.carac_monst[index],
            ...{ type: attribut[Math.floor(Math.random() * attribut.length)] },
        };
    }
}

let form = useForm({});

function combat_user(index) {
    // REF carte_cible => Permet d'affichager un index si le hero_hp ou le tableau est bon, sinon message d'erreur correspondant
    if (
        tableau_mystere.value[index].montrer_bataille != null &&
        props.hero_user.hp_restant > 0
    ) {
        console.log("oui");
        niveau_bataille.value = [props.outside_map[index], index];
        tableau_monstre = tableau_monstre_carte.value[index];
        tableau_mystere.value[index].montrer_bataille = true;
        console.log(typeof index);

        carte_cible.value = index;
    } else if (props.hero_user.hp_restant === 0) {
        message("Vie du Héro insuffisant");
    } else if (tableau_mystere.value[index].montrer_bataille === null) {
        message("Combat gagné");
    } else {
        message("Victoire ou vie du Héro insuffisant");
    }
}

function message(texte) {
    carte_cible.value = texte;
    // setTimeout(() => {
    //     carte_cible.value = "";
    // }, 3000);
}
</script>

<template>
    <AppLayout title="Exterieur">
        <main class="h-screen pt-16 bg-black" id="outside">
            <p
                class="bg-red-600 w-full text-white font-bold absolute text-2xl text-center"
            >
                {{ typeof carte_cible != "number" ? carte_cible : "" }}
            </p>
            <section class="index_info_hero">
                <figure class="">
                    <img
                        class="w-full rounded-t-xl"
                        :src="`/storage${hero_user.portrait}`"
                        alt=""
                    />
                </figure>

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
                <article
                    id="gain"
                    :class="
                        props.hero_user.hp_restant === 0 ? 'partir_gain' : ''
                    "
                >
                    <h1 class="text-center font-bold border-b-2 border-black">
                        GAIN TOTAL
                    </h1>
                    <p>EXP: {{ gain.exp }}</p>
                    <p>OR: {{ gain.or }}</p>
                    <button
                        class="bg-red-600 w-full border-2 border-black font-bold rounded-lg text-white"
                        @click="
                            () =>
                                $inertia.post(route('partir'), {
                                    gain,
                                })
                        "
                    >
                        Partir
                    </button>
                </article>
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
                    <p
                        v-if="tableau_mystere[index].montrer_bataille != null"
                        class="text-white"
                    >
                        Niveau {{ index + 1 }}
                    </p>
                    <p v-else class="text-white">GAGNÉ</p>
                </figure>
            </section>
        </main>

        <Combat
            v-if="tableau_mystere?.[carte_cible]?.montrer_bataille"
            class="element"
            :attaques_user="props.attaques_user"
            :hero_user="props.hero_user"
            :tableau_monstre_carte="tableau_monstre"
            :niveau_bataille="niveau_bataille"
            @gain_gagne_combat="
                (gain.or += $event.gain_gagne.or),
                    (gain.exp += $event.gain_gagne.exp),
                    (props.hero_user.hp_restant = $event.hp_restant)
            "
            @carte_info="
                (tableau_mystere[$event.index].img_mystere = $event.img),
                    (tableau_mystere[$event.index].montrer_bataille =
                        $event.montrer_bataille)
            "
        />
    </AppLayout>
</template>
