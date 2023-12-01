document.addEventListener("DOMContentLoaded", function () {
    multipleSelectDropdown(".printer-select", "máy in");
});

function multipleSelectDropdown(className, object) {
    const customSelects = document.querySelectorAll(className);

    function updateSelectedOptions(customSelect) {
        const selectedOptions = Array.from(customSelect.querySelectorAll(".option.active"))
        .filter(option => option !== customSelect.querySelector(".option.all-tags"))
        .map(function(option) {
            return  {
                value: option.getAttribute("data-value"),
                text: option.textContent.trim()
            };
        });

        const selectedValues = selectedOptions.map(function(option){
            return option.value;
        });

        customSelect.querySelector(".tags-input").value = selectedValues.join(', ');

        let tagsHTML = "";

        if(selectedOptions.length === 0) {
            tagsHTML = '<span class="placeholder">Chọn danh sách các '+object+'</span>';
        } else {
            selectedOptions.forEach(function(option){
                tagsHTML += '<span class="tag">'+option.text+'<button class="remove-tag" data-value="'+option.value+'">&times;</button></span>';
            });
        }

        customSelect.querySelector(".selected-options").innerHTML = tagsHTML;
    }

    customSelects.forEach(function(customSelect){
        const searchInput = customSelect.querySelector(".search-tags");
        const optionsContainer = customSelect.querySelector(".options");
        const noResultMessage = customSelect.querySelector(".no-result-message");
        const options = customSelect.querySelectorAll(".option");
        const allTagsOption = customSelect.querySelector(".option.all-tags");
        const clearButton = customSelect.querySelector(".clear");

        allTagsOption.addEventListener("click", function(){
            const isActive = allTagsOption.classList.contains("active");

            options.forEach(function(option){
                if(option !== allTagsOption){
                    option.classList.toggle("active", !isActive);
                }
            });

            updateSelectedOptions(customSelect);
        });

        clearButton.addEventListener("click", function(){
            searchInput.value = "";
            options.forEach(function(option){
                option.style.display = "block";
            });
            noResultMessage.style.display = "none";
        });

        searchInput.addEventListener("input", function(){
            const searchTerm = searchInput.value.toLowerCase();

            options.forEach(function(option){
                const optionText = option.textContent.trim().toLocaleLowerCase();
                const shouldShow = optionText.includes(searchTerm);
                option.style.display = shouldShow ? "block" : "none";
            });

            const anyOptionsMatch = Array.from(options).some(option => option.style.display === "block");
            noResultMessage.style.display = anyOptionsMatch ? "none" : "block";

            if(searchTerm) {
                optionsContainer.classList.add("option-search-active");
            } else {
                optionsContainer.classList.remove("option-search-active");
            }
        });
    });

    customSelects.forEach(function(customSelect){
        const options = customSelect.querySelectorAll(".option");
        options.forEach(function(option){
            option.addEventListener("click", function(){
                option.classList.toggle("active");
                updateSelectedOptions(customSelect);
            })
        })
    });

    document.querySelector(className).addEventListener("click", function(event){
        const removeTag = event.target.closest(".remove-tag");
        
        if(removeTag){
            const customSelect = removeTag.closest(className); console.log(customSelect)
            const valueToRemove = removeTag.getAttribute("data-value");
            const optionToRemove = customSelect.querySelector(".option[data-value='"+valueToRemove+"']");
            optionToRemove.classList.remove("active");

            const otherSelectedOptions = customSelect.querySelectorAll(".option.active:not(.all-tags)");
            const allTagsOption = customSelect.querySelector(".option.all-tags");

            if(otherSelectedOptions.length === 0) {
                allTagsOption.classList.remove("active");
            }

            updateSelectedOptions(customSelect);
        }
    })

    const selectBoxes = document.querySelector(className).querySelectorAll(".select-box");

    selectBoxes.forEach(function(selectBox){
        selectBox.addEventListener("click", function(event){
            if(!event.target.closest(".tag")) {
                selectBox.parentNode.classList.toggle("open");
            }
        });
    });

    document.addEventListener("click", function(event){
        if(!event.target.closest(className) && !event.target.classList.contains("remove-tag")) {
            customSelects.forEach(function(customSelect){
                customSelect.classList.remove("open");
            })
        }
    });

    function resetCustomSelects(){
        customSelects.forEach(function(customSelect){
            customSelect.querySelectorAll(".option.active")
            .forEach(function(option){
                option.classList.remove("active");
            });
            customSelect.querySelector(".option.all-tags").classList.remove("active");
            updateSelectedOptions(customSelect);
        });
    }

    updateSelectedOptions(customSelects[0]);
}