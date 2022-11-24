package org.example;

import java.awt.GridBagConstraints;
import java.awt.GridBagLayout;
import java.awt.Insets;
import java.util.Arrays;
import javax.swing.ImageIcon;
import javax.swing.JLabel;
import javax.swing.JPanel;

/**
 * see https://www.jc-mouse.net/
 *
 * @author mouse
 */
public class FilaDeColores extends JPanel {

    private GridBagConstraints gridBagConstraints;
    private JLabel label1;
    private JLabel label2;
    private JLabel label3;
    private JLabel label4;
    private String[] colores = {"", "", "", ""};

    /**
     * Constructor de clase
     */
    public FilaDeColores() {
        super();

        FilaDeColores.this.setLayout(new GridBagLayout());

        label1 = new JLabel();
        label1.setIcon(new ImageIcon(getClass().getResource("/org/example/resources/blanco.png")));
        label1.setText("");
        label1.setHorizontalTextPosition(javax.swing.SwingConstants.CENTER);
        gridBagConstraints = new GridBagConstraints();
        gridBagConstraints.gridx = 0;
        gridBagConstraints.gridy = 0;
        gridBagConstraints.anchor = GridBagConstraints.NORTHWEST;
        gridBagConstraints.insets = new Insets(5, 10, 5, 5);
        FilaDeColores.this.add(label1, gridBagConstraints);

        label2 = new JLabel();
        label2.setIcon(new ImageIcon(getClass().getResource("/org/example/resources/blanco.png")));
        label2.setText("");
        label2.setHorizontalTextPosition(javax.swing.SwingConstants.CENTER);
        gridBagConstraints = new GridBagConstraints();
        gridBagConstraints.gridx = 1;
        gridBagConstraints.gridy = 0;
        gridBagConstraints.anchor = GridBagConstraints.NORTHWEST;
        gridBagConstraints.insets = new Insets(5, 5, 5, 5);
        FilaDeColores.this.add(label2, gridBagConstraints);

        label3 = new JLabel();
        label3.setIcon(new ImageIcon(getClass().getResource("/org/example/resources/blanco.png")));
        label3.setText("");
        label3.setHorizontalTextPosition(javax.swing.SwingConstants.CENTER);
        gridBagConstraints = new GridBagConstraints();
        gridBagConstraints.gridx = 2;
        gridBagConstraints.gridy = 0;
        gridBagConstraints.anchor = GridBagConstraints.NORTHWEST;
        gridBagConstraints.insets = new Insets(5, 5, 5, 5);
        FilaDeColores.this.add(label3, gridBagConstraints);

        label4 = new JLabel();
        label4.setIcon(new ImageIcon(getClass().getResource("/org/example/resources/blanco.png")));
        label4.setText("");
        label4.setHorizontalTextPosition(javax.swing.SwingConstants.CENTER);
        gridBagConstraints = new GridBagConstraints();
        gridBagConstraints.gridx = 3;
        gridBagConstraints.gridy = 0;
        gridBagConstraints.anchor = GridBagConstraints.NORTHWEST;
        gridBagConstraints.insets = new Insets(5, 5, 5, 10);
        FilaDeColores.this.add(label4, gridBagConstraints);
    }

    /**
     * @param color puede ser "rojo", "amarillo", "verde", "azul", "salmon",
     * "naranja"
     * @return boolean TRUE si aun tiene celdas disponibles FALSE si ya esta
     * lleno
     */
    public boolean setColor(String color) {

        if (label1.getText().isEmpty()) {
            label1.setIcon(new ImageIcon(getClass().getResource("/org/example/resources/" + color + ".png")));
            label1.setText(color.substring(0, 1).toUpperCase());
            colores[0] = color;
            return true;
        }
        if (label2.getText().isEmpty()) {
            label2.setIcon(new ImageIcon(getClass().getResource("/org/example/resources/" + color + ".png")));
            label2.setText(color.substring(0, 1).toUpperCase());
            colores[1] = color;
            return true;
        }
        if (label3.getText().isEmpty()) {
            label3.setIcon(new ImageIcon(getClass().getResource("/org/example/resources/" + color + ".png")));
            label3.setText(color.substring(0, 1).toUpperCase());
            colores[2] = color;
            return true;
        }
        if (label4.getText().isEmpty()) {
            label4.setIcon(new ImageIcon(getClass().getResource("/org/example/resources/" + color + ".png")));
            label4.setText(color.substring(0, 1).toUpperCase());

            colores[3] = color;
        }
        return false;
    }

    /**
     * Compara patrones de colores de la fila actual con el patron de colores
     * ganador
     *
     * @param ganador Array con el patron de colores ganador
     * @param mostrarayuda
     * @return TRUE si la fila es ganadora
     */
    public boolean comparar(String[] ganador, boolean mostrarayuda) {
        if (mostrarayuda) {
            label1.setText(ganador[0].equals(colores[0]) ? "" : "x");
            label2.setText(ganador[1].equals(colores[1]) ? "" : "x");
            label3.setText(ganador[2].equals(colores[2]) ? "" : "x");
            label4.setText(ganador[3].equals(colores[3]) ? "" : "x");
        }
        return Arrays.equals(ganador, colores);
    }

}
