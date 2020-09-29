describe('Login', () => {

    describe('invalid credentials', () => {
        it('requires valid credentials', () => {
            cy.visit('/login', {failOnStatusCode: false});
            cy.get('#email').type('goooo@sdf.fds');
            cy.get('#password').type('goooo');
            cy.get('#submitLogin').click().wait(2000);
            cy.contains('Unauthorized');
        });
    });

    describe('valid credentials', () => {

        it('work with valid credentials', () => {
            cy.visit('/login', {failOnStatusCode: false});
            cy.get('#email').type('asd@asd.com');
            cy.get('#password').type('asdasd');
            cy.get('#submitLogin').click().wait(4000);
            cy.contains('My Todo');
        });
    });

    describe('Add task', () => {
        it('add item to our todo list', () => {
            cy.get('.todo-list-input').type('New TASK HAHAHAHAHAH');
            cy.get('.todo-list-add-btn').click();
            cy.contains('New TASK HAHAHAHAHAH');
        });
    });

    describe('task status', () => {

        it('change my task to completed', () => {
            cy.contains('New TASK HAHAHAHAHAH').click();
        });
    });

    describe('task delete', () => {

        it('delete completed task', () => {
            cy.get('.remove').click();
        });
    });
});
