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

let form = useForm({
    gain: { or: 0, exp: 0, hp_restant: props.hero_user.hp_restant },
});

let attribut = ["feu", "eau", "plante", "électrique"];
// nombre de monstre sur le champ de bataille
let difficulte_nbr_monstre = [1, 1, 1, 2, 2, 2, 3, 3, 4];
// let difficulte_nbr_monstre = [1, 1, 1, 1, 1, 1, 1, 1, 1];
let tableau_mystere = ref([]);
let niveau_bataille = ref(0);
let carte_cible = ref();
let tableau_monstre_carte = ref([]);
// let message_gain = ref([or]);

let message_gain = {};

function transfo(tableau_gain) {
    Object.entries(tableau_gain).forEach((value) => {
        let nom = value[0];
        let chiffre = String(value[1]);
        message_gain[nom] = "";
        for (let index = 0; index < chiffre.length; index++) {
            console.log(chiffre[index]);
            message_gain[nom] += chiffre[index];
            if (
                (chiffre.length - 1 - index) % 3 === 0 &&
                chiffre.length - index > 2
            ) {
                message_gain[nom] += ",";
            }
        }
    });
}

let message_afficher = ref("");
let tableau_monstre = [];
let tous_carte_reussi = [];

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

function combat_user(index) {
    message("");
    // REF carte_cible => Permet d'affichager un index si le hero_hp ou le tableau est bon, sinon message d'erreur correspondant
    if (
        tableau_mystere.value[index].montrer_bataille != null &&
        props.hero_user.hp_restant > 0
    ) {
        niveau_bataille.value = [props.outside_map[index], index];
        tableau_monstre = tableau_monstre_carte.value[index];
        tableau_mystere.value[index].montrer_bataille = true;

        carte_cible.value = index;
    } else if (props.hero_user.hp_restant === 0) {
        message("Vie du Héro insuffisant");
        timer(2);
    } else if (tableau_mystere.value[index].montrer_bataille === null) {
        message("Combat gagné");
        timer(2);
    } else {
        message("Victoire ou vie du Héro insuffisant");
        timer(2);
    }
}
let temps;
function timer(duree_message) {
    clearInterval(temps);
    temps = setInterval(() => {
        duree_message--;
        if (duree_message === 0) {
            message("");
            clearInterval(temps);
        }
    }, 1000);
}
function message(texte) {
    message_afficher.value = texte;
}
</script>

<template>
    <AppLayout title="Exterieur">
        <main class="h-screen pt-16 bg-black" id="outside">
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
                    v-if="message_gain.OR"
                    id="gain"
                    :class="
                        props.hero_user.hp_restant === 0 ||
                        tous_carte_reussi.length === 9
                            ? 'partir_gain'
                            : ''
                    "
                >
                    <h1 class="text-center font-bold border-b-2 border-black">
                        GAIN TOTAL
                    </h1>
                    <p v-for="value in Object.entries(message_gain)">
                        <span class="fond-bold">{{ value[0] }}</span
                        >: {{ value[1] }}
                    </p>
                    <!-- <p>EXP: {{ form.gain.exp }}</p>
                    <p>OR: {{ form.gain.or }}</p> -->
                    <button
                        class="bg-red-600 w-full border-2 border-black font-bold rounded-lg text-white"
                        @click="
                            () =>
                                $inertia.post(route('partir'), {
                                    form,
                                })
                        "
                    >
                        Partir
                    </button>
                </article>
            </section>

            <section class="grid grid-cols-3 relative">
                <p
                    v-if="message_afficher"
                    id="message_info"
                    class="bg-red-600 justify-self-center px-2 text-white font-extrabold text-2xl text-center absolute z-10 rounded-xl"
                >
                    {{ message_afficher }}
                </p>
                <figure
                    v-for="(carte, index) in tableau_mystere"
                    class="carte cursor-pointer"
                    @click="combat_user(index)"
                >
                    <img
                        class="rounded-xl"
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
                transfo({
                    OR: form.gain.or + $event.gain_gagne.or,
                    EXP: form.gain.exp + $event.gain_gagne.exp,
                }),
                    (form.gain.or += $event.gain_gagne.or),
                    (form.gain.exp += $event.gain_gagne.exp),
                    (form.gain.hp_restant = $event.hp_restant),
                    (props.hero_user.hp_restant = $event.hp_restant)
            "
            @carte_info="
                (tableau_mystere[$event.index].img_mystere = $event.img),
                    (tableau_mystere[$event.index].montrer_bataille =
                        $event.montrer_bataille),
                    tous_carte_reussi.push($event.index)
            "
        />
    </AppLayout>
</template>
