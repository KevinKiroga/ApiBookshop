<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class BookTest extends TestCase
{

    // Test para crear un libro
     public function test_create_books_success () {

        // Almacena los datos del libro
        $bookData = [
            "title" => "El nombre del viento",
            "author" => "Patrick Rothfuss",
            "bookgenre" => "Fantasía",
            "date" => "2018-01-01"
        ];

        // Hace una solicitud POST a la API para crear el libro
        $response = $this->post('api/books', [
            'title' => $bookData['title'],          // Pone el valor de "title" a la variable $bookData
            'author' => $bookData['author'],        // Pone el valor de "author" a la variable $bookData
            'bookgenre' => $bookData['bookgenre'],  // Pone el valor de "bookgenre" a la variable $bookData
            'date' => $bookData['date']             // Pone el valor de "date" a la variable $bookData
        ]);

        // Valida si se ha creado y si el estado sea 200
        $this->assertEquals(201, $response->getStatusCode());

        // Obtiene los datos del libro
        $responseData = json_decode($response->getContent(), true);

        // Verifica que los datos del libro coinciden con los enviados
        $this->assertEquals($bookData['title'], $responseData['title']);
        $this->assertEquals($bookData['author'], $responseData['author']);
        $this->assertEquals($bookData['bookgenre'], $responseData['bookgenre']);
        $this->assertEquals($bookData['date'], $responseData['date']);

     }
     // Test para una falla al crear un libro
     public function test_create_books_faild () {

        // Almacena los datos del libro
        $bookData = [
            "author" => "Patrick Rothfuss",
            "bookgenre" => "Fantasía",
            "date" => "2018-01-01"
        ];

        // Hace una solicitud POST a la API para crear el libro
        $response = $this->post('api/books', [
            'author' => $bookData['author'],            // Pone el valor de "author" a la variable $bookData
            'bookgenre' => $bookData['bookgenre'],      // Pone el valor de "bookgenre" a la variable $bookData
            'date' => $bookData['date']                 // Pone el valor de "date" a la variable $bookData
        ]);

        // Valida si se ha creado y si el estado sea 422
        $this->assertEquals(422, $response->getStatusCode());

        // Obtiene los datos del libro
        $responseData = json_decode($response->getContent(), true);

        // Mensaje esperado
        $messageError = "The title field is required.";

        // Verifica si el mensaje es correcto con el "messageError"
        $this->assertEquals($messageError, $responseData['errors']['title'][0]);


     }


     // Test para buscar un libro
    public function test_findById_show_books_success () {

        // Se define una variable por defecto
        $bookId = 2;

        // Hace una solicitud GET a la API para buscar el libro
        $response = $this->get('/api/books/' . $bookId);

        // Valida si se ha creado y si el estado sea 200
        $this->assertEquals(200, $response->getStatusCode());

        // Obtiene los datos del libro
        $bookData = json_decode($response->getContent(), true);

        // Verifica que los datos del libro coinciden con los enviados
        $this->assertEquals($bookId, $bookData['id']);

    }
    // Test para una falla al buscar un libro
    public function test_findById_show_books_faild () {

        // Se define una variable por defecto
        $bookId = 0;

        // Hace una solicitud GET a la API para buscar el libro
        $response = $this->get('/api/books/' . $bookId);

        // Valida si se ha creado y si el estado sea 404
        $this->assertEquals(404, $response->getStatusCode());

    }


    // Test para actualizar un libro
     public function test_update_books_success () {

        // Almacena los datos del libro
        $bookData = [
            "title" => "El nombre",
            "author" => "Patrick Rothfuss",
            "bookgenre" => "Fantasía",
            "date" => "2018-01-01"
        ];

        // Define el id del libro por defecto
        $bookId = 2;

        // Hace una solicitud PUT a la API para actualizar el libro
        $response = $this->put('api/books/' . $bookId, [
            'title' => $bookData['title'],
            'author' => $bookData['author'],
            'bookgenre' => $bookData['bookgenre'],
            'date' => $bookData['date']
        ]);

        // Valida si se ha creado y si el estado sea 200
        $this->assertEquals(200, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

        // Verificar que los datos del libro coinciden con los enviados
        $this->assertEquals($bookData['title'], $responseData['title']);
        $this->assertEquals($bookData['author'], $responseData['author']);
        $this->assertEquals($bookData['bookgenre'], $responseData['bookgenre']);
        $this->assertEquals($bookData['date'], $responseData['date']);

     }
     // Test para una falla al buscar un libro para actualizar
     public function test_findById_books_faild () {

        // Almacena los datos del libro
        $bookData = [
            "title" => "El nombre",
            "author" => "Patrick Rothfuss",
            "bookgenre" => "Fantasía",
            "date" => "2018-01-01"
        ];

        // Define el id del libro por defecto
        $bookId = 0;

        // Hace una solicitud PUT a la API para actualizar el libro
        $response = $this->put('api/books/' . $bookId, [
            'title' => $bookData['title'],
            'author' => $bookData['author'],
            'bookgenre' => $bookData['bookgenre'],
            'date' => $bookData['date']
        ]);

        // Valida si se ha creado y si el estado sea 404
        $this->assertEquals(404, $response->getStatusCode());

        // Obtiene los datos del libro
        $responseData = json_decode($response->getContent(), true);

        // Mensaje esperado
        $messageError = "No se ha encontrado el catalogo de libro";

        // Verifica si el mensaje es correcto con el "messageError"
        $this->assertEquals($messageError, $responseData['message']);
     }
     // Test para una falla al actualizar un libro
     public function test_update_books_faildd () {
        // Almacena los datos del libro
        $bookData = [
            "title" => "El nombre",
            "bookgenre" => "Fantasía",
            "date" => "2018-01-01"
        ];

        // Define el id del libro por defecto
        $bookId = 1;

        // Hace una solicitud PUT a la API para actualizar el libro
        $response = $this->put('api/books/' . $bookId, [
            'title' => $bookData['title'],
            'bookgenre' => $bookData['bookgenre'],
            'date' => $bookData['date']
        ]);

        // Valida si se ha creado y si el estado sea 422
        $this->assertEquals(422, $response->getStatusCode());

        // Obtiene los datos del libro
        $responseData = json_decode($response->getContent(), true);

        // Mensaje esperado
        $messageError = "The given data was invalid.";

        // Verifica si el mensaje es correcto con el "messageError"
        $this->assertEquals($messageError, $responseData['message']);

     }


     // Test para eliminar un libro
    public function test_findById_delete_books_success () {
        // Define el id del libro por defecto
        $bookId = 6;

        // Hace una solicitud DELETE a la API para eliminar el libro
        $response = $this->delete('/api/books/' . $bookId);

        // Valida si se ha creado y si el estado sea 204
        $this->assertEquals(204, $response->getStatusCode());
    }
    // Test para una falla al eliminar un libro
    public function test_findById_delete_book_faild () {

        // Define el id del libro por defecto
        $bookId = 0;

        // Hace una solicitud DELETE a la API para eliminar el libro
        $response = $this->delete('/api/books/' . $bookId);

        // Valida si se ha creado y si el estado sea 404
        $this->assertEquals(404, $response->getStatusCode());

        // Obtiene los datos del libro
        $responseData = json_decode($response->getContent(), true);

        // Mensaje esperado
        $messageError = "No se ha encontrado el catalogo de libro";

        // Verifica si el mensaje es correcto con el "messageError"
        $this->assertEquals($messageError, $responseData['message']);
    }


}
