document.addEventListener('DOMContentLoaded', function () {
    const statElements = document.querySelectorAll('.stat');
    const statImages = document.querySelectorAll('.statImage');
    const levelImage = document.getElementById('levelImage')
    const currentXp = document.getElementById('level').innerText;


    // Función para calcular el progreso
    function calculateProgress(currentXp, requiredXp) {
        return (currentXp / requiredXp) * 100;
    }

    // Función para actualizar las barras de progreso
    function updateProgressBar() {
        const stats = ['strength', 'intelligence', 'constitution', 'charisma'];
        stats.forEach(stat => {
            const current = parseInt(document.getElementById(`${stat}-current`).innerText);
            const required = parseInt(document.getElementById(`${stat}-required`).innerText);
            const progress = calculateProgress(current, required);

            document.getElementById(`${stat}-progress`).style.width = progress + '%';
        });
    }

    function imageLevel() {
        if (currentXp <= 10) {
            levelImage.src = '/images/lvlup0.png'
        } else if (currentXp <= 20) {
            levelImage.src = '/images/lvlup20.png'
        } else if (currentXp <= 40) {
            levelImage.src = '/images/lvlup40.png';
        } else if (currentXp <= 60) {
            levelImage.src = '/images/lvlup60.png';
        } else {
            levelImage.src = '/images/lvlup60.png';
        }

    }

    function setStatImages() {
        statElements.forEach((statElement, index) => {
            const stat = statElement.innerText;
            const imageElement = statImages[index];

            switch (stat) {
                case 'Strength':
                    imageElement.src = '/images/strengthSTAT.png';
                    break;
                case 'Intelligence':
                    imageElement.src = '/images/intelligenceSTAT.png';
                    break;
                case 'Constitution':
                    imageElement.src = '/images/constitutionSTAT.png';
                    break;
                case 'Charisma':
                    imageElement.src = '/images/charismaSTAT.png';
                    break;
            }
        });


    }

    imageLevel();
    setStatImages();
    updateProgressBar();
});
