<?php

namespace Controllers\Maintenance\Books;

use Controllers\PrivateController;
use Dao\Books\Books as BooksDAO;
use Views\Renderer;

use Utilities\Site;
use Utilities\Validators;

const LIST_URL = "index.php?page=Maintenance-Books-Books";

class Book extends PrivateController
{
    private array $viewData;
    private array $modes;
    public function __construct()
    {
        $this->viewData = [
            "mode" => "",
            "id_libro" => 0,
            "titulo" => "",
            "autor" => "",
            "genero" => "",
            "publicacion_year" => 0,
            "editora" => "",
            "precio" => 0,
            "modeDsc" => "",
            "errors" => [],
            "cancelLabel" => "Cancel",
            "showConfirm" => true,
            "readonly" => ""
        ];
        $this->modes = [
            "INS" => "New Category",
            "UPD" => "Updating %s",
            "DEL" => "Deleting %s",
            "DSP" => "Details of %s"
        ];
    }
    public function run(): void
    {
        
        $this->getQueryParamsData();
        if ($this->viewData["mode"] !== "INS") {
            $this->getDataFromDB();
        }
        if ($this->isPostBack()) {
            $this->getBodyData();
            if ($this->validateData()) {
                $this->processData();
            }
        }
        $this->prepareViewData();
        Renderer::render("maintenance/books/book", $this->viewData);
    }

    private function throwError(string $message, string $logMessage = "")
    {
        if (!empty($logMessage)) {
            error_log(sprintf("%s - %s", $this->name, $this->$logMessage));
        }
        Site::redirectToWithMsg(LIST_URL, $message);
    }
    private function innerError(string $scope, string $message)
    {
        if (!isset($this->viewData["errors"][$scope])) {
            $this->viewData["errors"][$scope] = [$message];
        } else {
            $this->viewData["errors"][$scope][] = $message;
        }
    }

    private function getQueryParamsData()
    {
        if (!isset($_GET["mode"])) {
            $this->throwError(
                "Something went wrong, try again.",
                "Attempt to load controler without the required query parameters MODE"
            );
        }
        $this->viewData["mode"] = $_GET["mode"];
        if (!isset($this->modes[$this->viewData["mode"]])) {
            $this->throwError(
                "Something went wrong, try again.",
                "Attempt to load controler with  wrong value on query parameter MODE - " . $this->viewData["mode"]
            );
        }
        if ($this->viewData["mode"] !== "INS") {
            if (!isset($_GET["id_libro"])) {
                $this->throwError(
                    "Something went wrong, try again.",
                    "Attempt to load controler without the required query parameters ID"
                );
            }
            if (!is_numeric($_GET["id_libro"])) {
                $this->throwError(
                    "Something went wrong, try again.",
                    "Attempt to load controler with  wrong value on query parameter ID - " . $_GET["id_libro"]
                );
            }
            $this->viewData["id_libro"] = intval($_GET["id_libro"]);
        }
    }

    private function getDataFromDB()
    {
        $tmpLibro = BooksDAO::getBooksById(
            $this->viewData["id_libro"]
        );
        if ($tmpLibro && count($tmpLibro) > 0) {
            $this->viewData["titulo"] = $tmpLibro["titulo"];
            $this->viewData["autor"] = $tmpLibro["autor"];
            $this->viewData["genero"] = $tmpLibro["genero"];
            $this->viewData["publicacion_year"] = $tmpLibro["publicacion_year"];
            $this->viewData["editora"] = $tmpLibro["editora"];
            $this->viewData["precio"] = $tmpLibro["precio"];
        } else {
            $this->throwError(
                "Something went wrong, try again.",
                "Record for id_libro " . $this->viewData["id_libro"] . " not found."
            );
        }
    }

    private function getBodyData()
    {
        if (!isset($_POST["id_libro"])) {
            $this->throwError(
                "Something went wrong, try again.",
                "Trying to post without parameter ID on body"
            );
        }
        if (!isset($_POST["titulo"])) {
            $this->throwError(
                "Something went wrong, try again.",
                "Trying to post without parameter LIBRO on body"
            );
        }
        if (!isset($_POST["autor"])) {
            $this->throwError(
                "Something went wrong, try again.",
                "Trying to post without parameter AUTOR on body"
            );
        }
        if (!isset($_POST["genero"])) {
            $this->throwError(
                "Something went wrong, try again.",
                "Trying to post without parameter GENERO on body"
            );
        }
        if (!isset($_POST["publicacion_year"])) {
            $this->throwError(
                "Something went wrong, try again.",
                "Trying to post without parameter publicacion_year on body"
            );
        }
        if (!isset($_POST["editora"])) {
            $this->throwError(
                "Something went wrong, try again.",
                "Trying to post without parameter EDITORA on body"
            );
        }
        if (!isset($_POST["precio"])) {
            $this->throwError(
                "Something went wrong, try again.",
                "Trying to post without parameter PRECIO on body"
            );
        }
        if (!isset($_POST["xsrtoken"])) {
            $this->throwError(
                "Something went wrong, try again.",
                "Trying to post without parameter XSRTOKEN on body"
            );
        }
        if (intval($_POST["id_libro"]) !== $this->viewData["id_libro"]) {
            $this->throwError(
                "Something went wrong, try again.",
                "Trying to post with inconsistent parameter ID value has: " . $this->viewData["id_libro"] . " recieved: " . $_POST["id_libro"]
            );
        }
        if ($_POST["xsrtoken"] !==  $_SESSION[$this->name . "-xsrtoken"]) {
            $this->throwError(
                "Something went wrong, try again.",
                "Trying to post with inconsistent parameter XSRToken value has: " . $_SESSION[$this->name . "-xsrtoken"] . " received: " . $_POST["xsrtoken"]
            );
        }

        $this->viewData["titulo"] = $_POST["titulo"];
        $this->viewData["autor"] = $_POST["autor"];
        $this->viewData["genero"] = $_POST["genero"];
        $this->viewData["publicacion_year"] = intval($_POST["publicacion_year"]);
        $this->viewData["editora"] = $_POST["editora"];
        $this->viewData["precio"] = $_POST["precio"];
    }

    private function validateData(): bool
    {
        if (Validators::IsEmpty($this->viewData["titulo"])) {
            $this->innerError("titulo", "This field is required.");
        }
        if (strlen($this->viewData["titulo"]) > 100) {
            $this->innerError("titulo", "Value is too long. Maximun allowed 100 character.");
        }
        if (Validators::IsEmpty($this->viewData["autor"])) {
            $this->innerError("autor", "This field is required.");
        }
        if (strlen($this->viewData["autor"]) > 50) {
            $this->innerError("autor", "Value is too long. Maximun allowed 50 character.");
        }
        if (Validators::IsEmpty($this->viewData["genero"])) {
            $this->innerError("genero", "This field is required.");
        }
        if (strlen($this->viewData["genero"]) > 50) {
            $this->innerError("genero", "Value is too long. Maximun allowed 100 character.");
        }
        if (Validators::IsEmpty($this->viewData["publicacion_year"])) {
            $this->innerError("publicacion_year", "This field is required.");
        }
        if (strlen($this->viewData["publicacion_year"]) > intval(date("Y"))) {
            $this->innerError("publicacion_year", "Value is too long. Maximun allowed is current year.");
        }
        if (Validators::IsEmpty($this->viewData["editora"])) {
            $this->innerError("editora", "This field is required.");
        }
        if (strlen($this->viewData["editora"]) > 50) {
            $this->innerError("editora", "Value is too long. Maximun allowed 100 character.");
        }
        if (Validators::IsEmpty($this->viewData["precio"])) {
            $this->innerError("precio", "This field is required.");
        }
        if ($this->viewData["precio"] < 0) {
            $this->innerError("precio", "This field should be positive.");
        }

        return !(count($this->viewData["errors"]) > 0);
    }

    private function processData()
    {
        $mode = $this->viewData["mode"];
        switch ($mode) {
            case "INS":
                if (BooksDAO::newBook(
                    $this->viewData["titulo"],
                    $this->viewData["autor"],
                    $this->viewData["genero"],
                    $this->viewData["publicacion_year"],
                    $this->viewData["editora"],
                    $this->viewData["precio"]
                ) > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Book created successfuly");
                } else {
                    $this->innerError("global", "Something wrong happend to save the new Book.");
                }
                break;
            case "UPD":
                if (BooksDAO::updateBook(
                    $this->viewData["id_libro"],
                    $this->viewData["titulo"],
                    $this->viewData["autor"],
                    $this->viewData["genero"],
                    $this->viewData["publicacion_year"],
                    $this->viewData["editora"],
                    $this->viewData["precio"]
                ) > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Book updated successfuly");
                } else {
                    $this->innerError("global", "Something wrong happend while updating the book.");
                }
                break;
            case "DEL":
                if (BooksDAO::deleteBook(
                    $this->viewData["id_libro"]
                ) > 0) {
                    Site::redirectToWithMsg(LIST_URL, "Book deleted successfuly");
                } else {
                    $this->innerError("global", "Something wrong happend while deleting the book.");
                }
                break;
        }
    }
    private function prepareViewData()
    {
        $this->viewData["modeDsc"] = sprintf(
            $this->modes[$this->viewData["mode"]],
            $this->viewData["titulo"]
        );

        if (count($this->viewData["errors"]) > 0) {
            foreach ($this->viewData["errors"] as $scope => $errorsArray) {
                $this->viewData["errors_" . $scope] = $errorsArray;
            }
        }

        if ($this->viewData["mode"] === "DSP") {
            $this->viewData["cancelLabel"] = "Back";
            $this->viewData["showConfirm"] = false;
        }

        if ($this->viewData["mode"] === "DSP" || $this->viewData["mode"] === "DEL") {
            $this->viewData["readonly"] = "readonly";
        }
        $this->viewData["timestamp"] = time();
        $this->viewData["xsrtoken"] = hash("sha256", json_encode($this->viewData));
        $_SESSION[$this->name . "-xsrtoken"] = $this->viewData["xsrtoken"];
    }
}
