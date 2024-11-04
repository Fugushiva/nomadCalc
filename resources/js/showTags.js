const URL = '/api/category/';
const inputCategory = document.getElementById('category')
const tagsContainer = document.getElementById('tagsContainer')
let tags = [];
let label, checkbox, div; //elements for tagRessources

/**
 * Allow multi attribute on a specified HTML elemnt
 * 
 * @param {string} element HTML element
 * @param {object} attributes 
 */
function setAttributes(element, attributes) {
    for (let key in attributes) {
        element.setAttribute(key, attributes[key]);
    }
}

//show tags for a given category
async function showTagsName() {
    const response = await fetch(URL + inputCategory.value, {
        method: 'GET',
    }).then(res => res.json())
    .catch(error => console.error('No response, verify resource'));

    if (response && response.tags) {
        tags = response.tags;
        tagsContainer.innerHTML = null;

        // Récupère les tags déjà associés à la dépense depuis l'attribut data
        const expenseTags = JSON.parse(tagsContainer.getAttribute('data-expense-tags') || '[]');

        // Boucle sur les tags récupérés
        for (let i = 0; i < tags.length; i++) {
            // Création des éléments
            const label = document.createElement('label');
            const checkbox = document.createElement('input');
            const div = document.createElement('div');

            // Attributs des éléments
            div.setAttribute('class', 'flex gap-2 w-fit bg-white text-blue-500 rounded hover:bg-sky-700 hover:text-white');
            setAttributes(label, {
                for: 'tag' + tags[i].id,
                class: 'py-1 px-2'
            });
            setAttributes(checkbox, {
                name: 'tags[]',
                id: 'tag' + tags[i].id,
                type: 'checkbox',
                class: "mt-2 ml-2",
                value: tags[i].id,
            });

            // Coche la case si le tag est associé à la dépense
            if (expenseTags.includes(tags[i].id)) {
                checkbox.checked = true;
            }

            // Texte du label
            label.textContent = tags[i].name;

            // Construction HTML
            tagsContainer.appendChild(div);
            div.appendChild(checkbox);  // Ajout de la checkbox d'abord
            div.appendChild(label);     // Puis le label avec le texte
        }
    }
}


//fetch for the current choice
showTagsName();

inputCategory.addEventListener('change', () => {
    showTagsName();
})