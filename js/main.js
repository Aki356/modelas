const imageWrappers = document.querySelectorAll('.image-wrapper');

imageWrappers.forEach(wrapper => {
    const tooltip = wrapper.querySelector('.tooltip');
    const image = wrapper.querySelector('.hover-image');

    image.addEventListener('mouseover', () => {
        tooltip.style.display = 'block';
    });

    image.addEventListener('mousemove', (event) => {
      const tooltipRect = tooltip.getBoundingClientRect();
      const offsetX = 10; // Отступ справа от курсора
      const offsetY = 10; // Отступ снизу от курсора

      let left = event.pageX + offsetX;
      let top = event.pageY + offsetY;

      // Проверяем, не выходит ли подсказка за правую границу экрана
      if (left + tooltipRect.width > window.innerWidth) {
          left = event.pageX - tooltipRect.width - offsetX; // Перемещаем влево
      }

      // Проверяем, не выходит ли подсказка за нижнюю границу экрана
      if (top + tooltipRect.height > window.innerHeight) {
          top = event.pageY - tooltipRect.height - offsetY; // Перемещаем вверх
      }

      tooltip.style.left = `${left}px`;
      tooltip.style.top = `${top}px`;
    });

    image.addEventListener('mouseout', () => {
        tooltip.style.display = 'none'; // Скрываем подсказку
    });
});