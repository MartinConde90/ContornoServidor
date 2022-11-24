package org.example;

import java.awt.GridLayout;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.List;
import javax.swing.JOptionPane;
import javax.swing.JPanel;

/**
 * @see https://www.jc-mouse.net
 * @author mouse
 */
public class Juego {

    private JPanel panel;
    private int index;
    private ArrayList<FilaDeColores> filas;
    private final String[] COLORES = {"rojo", "amarillo", "verde", "azul", "salmon", "naranja"};
    private String[] ganador = new String[4];
    private boolean mostrarayuda = true;

    public Juego(JPanel panel) {
        this.panel = panel;
    }

    /**
     * Constructor de clase
     */
    public void iniciar() {
        //Genera un patron de 4 colores ganador
        List<String> lista = Arrays.asList(COLORES);
        Collections.shuffle(lista);
        for (int i = 0; i <= 3; i++) {
            ganador[i] = lista.get(i);
        }
        System.out.println("Patrón ganador: " + ganador[0] + " " + ganador[1] + " " + ganador[2] + " " + ganador[3]);

        //agrega 9 filas de colores al panel
        panel.removeAll();
        panel.setLayout(new GridLayout(9, 1));
        filas = new ArrayList<>();
        for (int i = 1; i <= 9; i++) {
            filas.add(new FilaDeColores());
        }
        index = filas.size() - 1;
        filas.forEach((f) -> {
            panel.add(f);
        });
        panel.updateUI();
    }

    public boolean isMostrarayuda() {
        return mostrarayuda;
    }

    public void setMostrarayuda(boolean mostrarayuda) {
        this.mostrarayuda = mostrarayuda;
    }

    /**
     * Agrega un color a la fila de colores activa (index), si la fila de
     * colores ya no cuenta con espacios en blanco, sube un nivel (-1) Si ya no
     * existen niveles disponibles y el jugador a llenado todos los espacios sin
     * acertar el patron de colores ganador, PIERDE EL JUEGO
     *
     * Cuando una fila de colores es completada, se revisa si el usuario a
     * acertado con el patron de colores ganador
     *
     * @param color puede ser "rojo", "amarillo", "verde", "azul", "salmon",
     * "naranja"
     */
    public void setColor(String color) {
        if (!filas.get(index).setColor(color)) {
            index -= 1;
            if (index < 0) {
                JOptionPane.showMessageDialog(null, "Perdiste!!!.", "Atención", JOptionPane.INFORMATION_MESSAGE);
                continuarjugando();
            } else {
                if (filas.get(index + 1).comparar(ganador, mostrarayuda)) {
                    JOptionPane.showMessageDialog(null, "Tu ganas!!!.", "Atención", JOptionPane.INFORMATION_MESSAGE);
                    continuarjugando();
                }
            }
        }

    }

    /**
     * Muestra una ventana de dialogo preguntando al usuario si desea seguir
     * jugando
     */
    private void continuarjugando() {
        int dialogResult = JOptionPane.showConfirmDialog(null, "¿Seguir jugando?", "Atención", JOptionPane.YES_NO_OPTION);
        if (dialogResult == JOptionPane.YES_OPTION) {
            iniciar();
        } else {
            System.exit(0);
        }
    }

}
