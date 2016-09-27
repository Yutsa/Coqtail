CREATE TABLE `UTILISATEURS` (
  `id_utilisateur` VARCHAR(42),
  `nom` VARCHAR(42),
  `sel` VARCHAR(42),
  `hash` VARCHAR(42),
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `MET_DANS_PANIER` (
  `id_utilisateur` VARCHAR(42),
  `id_cocktail` VARCHAR(42),
  PRIMARY KEY (`id_utilisateur`, `id_cocktail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `COCKTAIL` (
  `id_cocktail` VARCHAR(42),
  `titre` VARCHAR(42),
  `ingrédients` VARCHAR(42),
  `préparation` VARCHAR(42),
  PRIMARY KEY (`id_cocktail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `COMPOSER` (
  `id_ingrédient` VARCHAR(42),
  `id_cocktail` VARCHAR(42),
  PRIMARY KEY (`id_ingrédient`, `id_cocktail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `INGRÉDIENTS` (
  `id_ingrédient` VARCHAR(42),
  `nom_ingrédient` VARCHAR(42),
  PRIMARY KEY (`id_ingrédient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `CATEGORIE` (
  `id_ingrédient` VARCHAR(42),
  `id_ingrédient sous-catégorie` VARCHAR(42),
  PRIMARY KEY (`id_ingrédient`, `id_ingrédient sous-catégorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `MET_DANS_PANIER` ADD FOREIGN KEY (`id_cocktail`) REFERENCES `COCKTAIL` (`id_cocktail`);
ALTER TABLE `MET_DANS_PANIER` ADD FOREIGN KEY (`id_utilisateur`) REFERENCES `UTILISATEURS` (`id_utilisateur`);
ALTER TABLE `COMPOSER` ADD FOREIGN KEY (`id_cocktail`) REFERENCES `COCKTAIL` (`id_cocktail`);
ALTER TABLE `COMPOSER` ADD FOREIGN KEY (`id_ingrédient`) REFERENCES `INGRÉDIENTS` (`id_ingrédient`);
ALTER TABLE `CATEGORIE` ADD FOREIGN KEY (`id_ingrédient sous-catégorie`) REFERENCES `INGRÉDIENTS` (`id_ingrédient`);
ALTER TABLE `CATEGORIE` ADD FOREIGN KEY (`id_ingrédient`) REFERENCES `INGRÉDIENTS` (`id_ingrédient`);
