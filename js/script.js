const $body = document.querySelector('body'),
    $mobileMenu = $body.querySelector('.js-mobile-menu'),
    $menuBtn = $body.querySelector('.js-menu-btn'),
    $regUserBtn = $body.querySelector('.js-reg-user'),
    $logUserBtn = $body.querySelector('.js-log-user'),
    $errorBlock = $body.querySelector('.js-error-block'),
    $shoppingCenters = $body.querySelectorAll('.js-shopping-center'),
    $modal = $body.querySelector('.js-modal'),
    $modalTitle = $body.querySelector('.js-modal-title'),
    $modalClose = $body.querySelectorAll('.js-modal-close'),
    $modalBack = $body.querySelector('.js-modal-back'),
    $modalFloorContent = $body.querySelector('.js-modal-floor'),
    $modalFloorSelect = $body.querySelector('.js-floors-select'),
    $modalFoodPoints = $body.querySelector('.js-food-points');

const showErrorMess = (errorMess) => {
    $errorBlock.textContent = errorMess;
    $errorBlock.classList.add('active');
};

const hideErrorMess = () => {
    $errorBlock.textContent = '';
    $errorBlock.classList.remove('active');
};

const sendData = (method, login, pass, email = '') => {
    $.ajax({
        url: './ajax/auth.php',
        type: 'POST',
        cache: false,
        data: {
            'method': method,
            'login': login,
            'email': email,
            'pass': pass
        },
        dataType: 'html',
        success: function(data) {
            if (data != 'Ok') {
                showErrorMess(data);
            } else {
                hideErrorMess();

                location.replace("/");
            }
        }
    });
};

const regUser = () => {
    const loginValue = document.querySelector('.js-auth-login').value,
        emailValue = document.querySelector('.js-auth-email').value,
        passValue = document.querySelector('.js-auth-pass').value;

    let errorMess = '';

    if (loginValue.length < 5) {
        errorMess = 'Слишком короткий логин';

        showErrorMess(errorMess);

        return;
    } else if (emailValue.length < 8) {
        errorMess = 'Слишком короткий Email';

        showErrorMess(errorMess);

        return;
    } else if (passValue.length < 8) {
        errorMess = 'Слишком короткий пароль';

        showErrorMess(errorMess);

        return;
    }
    hideErrorMess();
    sendData('reg', loginValue, passValue, emailValue);
};

const logUser = () => {
    const loginValue = document.querySelector('.js-auth-login').value,
        passValue = document.querySelector('.js-auth-pass').value;

    sendData('log', loginValue, passValue);
};

const showModal = () => {
    $body.style.overflowY = 'hidden';
    $modal.classList.add('active');

};

const hideModal = () => {
    $body.style.overflowY = 'auto';
    $modal.classList.remove('active');
};

const appendFloorSelect = (floors) => {
    $modalFloorSelect.innerHTML = '';
    
    for (let i = 1; i <= floors; i++) {
        $modalFloorSelect.insertAdjacentHTML(
            "beforeend",
            `
            <option value="${i}">${i} этаж</option>
            `
        );
    }
    $modalFloorSelect.querySelector('option')
        .setAttribute('selected', true);
};

const appendFoodPoints = (points) => {
    $modalFoodPoints.innerHTML = '';

    if (points.length == 0) {
        $modalFoodPoints.insertAdjacentHTML(
            "beforeend",
            `
            <h3>Нет точек питания</h3>
            `
        );
        $modalFloorContent.classList.add('active');
        showModal();

        return;
    }

    for (let i = 0; i < points.length; i++) {
        $modalFoodPoints.insertAdjacentHTML(
            "beforeend",
            `
            <a href="products.php?point=${points[i]['id']}" class="food-point" data-id="${points[i]['id']}">
                <div class="food-point__img">
                    <img src="./images/food-points/${points[i]['img']}" alt="${points[i]['name']}">
                </div>
                <h4 class="food-point__title js-food-point-title">${points[i]['name']}</h4>
            </a>
            `
        );
    }

    $modalFloorContent.classList.add('active');
    showModal();
};

const getFoodPoints = (id, floor) => {
    $.ajax({
        url: './ajax/points.php',
        type: 'POST',
        cache: false,
        data: {
            'id': id,
            'floor': floor,
        },
        dataType: 'html',
        success: function(data) {
            appendFoodPoints(JSON.parse(data));
        }
    });
};

const showFloorsContent = (shoppingCenter) => {
    const $shoppingCenterTitle = shoppingCenter.parentElement.parentElement.querySelector('.js-shopping-center-title');

    const shoppingCenterId = shoppingCenter.dataset.id,
        shoppingCenterFloors = shoppingCenter.dataset.floors;

    $modalFloorSelect.dataset.id = shoppingCenterId;
    $modalTitle.textContent = $shoppingCenterTitle.textContent;

    appendFloorSelect(shoppingCenterFloors);
    getFoodPoints(shoppingCenterId, 1);
};

const hideFloorsContent = () => {
    $modalFloorContent.classList.remove('active');
};

if ($menuBtn) {
    $menuBtn.addEventListener('click', () => {
        if ($menuBtn.classList.contains('active')) {
            $menuBtn.classList.remove('active');
            $mobileMenu.classList.remove('active');
    
            $body.style.overflowY = 'auto';
        } else {
            $menuBtn.classList.add('active');
            $mobileMenu.classList.add('active');
    
            $body.style.overflowY = 'hidden';
        }
    });
}

// auth

if ($regUserBtn) {
    $regUserBtn.addEventListener('click', (e) => {
        e.preventDefault();

        regUser();
    });
}

if ($logUserBtn) {
    $logUserBtn.addEventListener('click', (e) => {
        e.preventDefault();

        logUser();
    });
}

// -auth-

$shoppingCenters.forEach(shoppingCenter => {
    shoppingCenter.addEventListener('click', () => {
        showFloorsContent(shoppingCenter);
    });
});

if ($modalFloorSelect) {
    $modalFloorSelect.addEventListener('change', (e) => {
        const id = e.target.dataset.id,
            floor = e.target.value;

        getFoodPoints(id, floor);
    });
}

$modalClose.forEach(modalCloseItem => {
    modalCloseItem.addEventListener('click', () => {
        hideModal();
    });
});

if ($modalBack) {
    $modalBack.addEventListener('click', () => {
        hideMenuContent();
    
        $modalFloorContent.classList.add('active');
    });
}
